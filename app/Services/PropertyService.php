<?php

namespace App\Services;

use App\Actions\UploadGalleryImagesAction;
use App\Actions\UploadLogoAction;
use App\Models\EditorImage;
use App\Models\Property;
use App\Models\User;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PropertyService
{
    public function __construct(
        protected UploadLogoAction $uploadLogoAction,
        protected UploadGalleryImagesAction $uploadGalleryImagesAction
    ) {}

    public function createFullProperty(User $user, Request $request): Property
    {
        $this->validateProperty($request);

        $property = $user->properties()->create($this->buildPropertyData($request));

        $this->handleSettings($property, $request);
        $this->handleReview($property, $request);
        $this->handleBeforeYouGo($property, $request);

        if ($request->hasFile('logo')) {
            $this->uploadLogoAction->execute($request->file('logo'), $property);
        }

        if ($request->hasFile('gallery')) {
            $this->uploadGalleryImagesAction->execute($property, $request->file('gallery'));
        }

        $this->syncExtras($property, $request);
        $property->recommendations()->sync($request->input('recommendation_ids', []));

        // Handle editor images after property is created
        $this->handleEditorImages($property, $request);

        return $property;
    }

    public function updateFullProperty(Property $property, Request $request): void
    {
        $this->validateProperty($request, $property->id);

        $property->update($this->buildPropertyData($request));

        $this->handleSettings($property, $request);
        $this->handleReview($property, $request);
        $this->handleBeforeYouGo($property, $request);

        if ($request->hasFile('logo')) {
            $this->uploadLogoAction->execute($request->file('logo'), $property);
        }

        if ($request->hasFile('gallery')) {
            $this->uploadGalleryImagesAction->execute($property, $request->file('gallery'));
        }

        $this->syncExtras($property, $request);
        $property->recommendations()->sync($request->input('recommendation_ids', []));

        // Handle editor images after property is updated
        $this->handleEditorImages($property, $request);
    }

    /**
     * Handle editor images - link them to property and clean up orphaned ones
     */
    protected function handleEditorImages(Property $property, Request $request): void
    {
        // Get all content fields that might contain editor images
        $contentFields = [
            'welcome_message',
            'amenities_description',
            'location_description',
            'checkin_instructions',
            'checkout_instructions',
        ];

        // Also check dynamic content
        if ($property->beforeYouGo) {
            $contentFields[] = 'before_you_go_content';
        }

        // Extract all image URLs from content
        $allImageUrls = [];

        foreach ($contentFields as $field) {
            $content = '';

            if ($field === 'before_you_go_content') {
                $content = $property->beforeYouGo->content ?? '';
            } else {
                $content = $property->$field ?? '';
            }

            if (! empty($content)) {
                preg_match_all('/<img[^>]+src="([^"]+)"/', $content, $matches);
                if (! empty($matches[1])) {
                    $cloudinaryUrls = array_filter($matches[1], function ($url) {
                        return strpos($url, 'cloudinary.com') !== false;
                    });
                    $allImageUrls = array_merge($allImageUrls, $cloudinaryUrls);
                }
            }
        }

        // Remove duplicates
        $allImageUrls = array_unique($allImageUrls);

        // Link new images to this property
        if (! empty($allImageUrls)) {
            EditorImage::whereIn('url', $allImageUrls)
                ->where('user_id', Auth::id())
                ->where(function ($query) {
                    $query->whereNull('imageable_type')
                        ->orWhere('imageable_type', '');
                })
                ->update([
                    'imageable_type' => Property::class,
                    'imageable_id' => $property->id,
                ]);
        }

        // Clean up orphaned images (linked to this property but not in content anymore)
        $this->cleanupOrphanedPropertyImages($property, $allImageUrls);

        // Handle editor_image_ids from form if provided
        if ($request->has('editor_image_ids')) {
            $imageIds = json_decode($request->input('editor_image_ids'), true);
            if (is_array($imageIds)) {
                EditorImage::whereIn('id', $imageIds)
                    ->where('user_id', Auth::id())
                    ->whereNull('imageable_type')
                    ->update([
                        'imageable_type' => Property::class,
                        'imageable_id' => $property->id,
                    ]);
            }
        }
    }

    /**
     * Clean up orphaned images for a specific property
     */
    protected function cleanupOrphanedPropertyImages(Property $property, array $currentImageUrls): void
    {
        // Get all editor images linked to this property
        $linkedImages = EditorImage::where('imageable_type', Property::class)
            ->where('imageable_id', $property->id)
            ->get();

        foreach ($linkedImages as $image) {
            // If image is not in current content, delete it
            if (! in_array($image->url, $currentImageUrls)) {
                try {
                    Log::info('Deleting orphaned editor image', [
                        'property_id' => $property->id,
                        'image_id' => $image->id,
                        'url' => $image->url,
                    ]);

                    // Delete from Cloudinary and database
                    $image->deleteWithCloudinary();

                } catch (\Exception $e) {
                    Log::error('Failed to delete orphaned editor image', [
                        'property_id' => $property->id,
                        'image_id' => $image->id,
                        'error' => $e->getMessage(),
                    ]);
                }
            }
        }
    }

    protected function validateProperty(Request $request, $id = null): void
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|regex:/^[a-z0-9\-]+$/|unique:properties,slug,'.$id,
            'address' => 'required|string|max:255',
            'welcome_title' => 'required|string|max:255',
            'welcome_message' => 'required|string',
            'checkin' => 'required|string',
            'checkout' => 'required|string',
            'checkin_instructions' => 'required|string',
            'checkout_instructions' => 'required|string',
            'location_area' => 'required|string|max:255',
            'location_country' => 'required|string|max:255',
            'location_description' => 'required|string',
            'google_map_url' => 'nullable|url',
            'property_directions' => 'nullable|url',
        ], [
            'slug.regex' => 'The slug must only contain lowercase letters, numbers, and hyphens.',
        ]);
    }

    protected function buildPropertyData(Request $request): array
    {
        return [
            'name' => $request->name,
            'slug' => Str::slug($request->slug ?? $request->name),
            'address' => $request->address,
            'enabled_pages' => $request->input('enabled_pages', []),
            'is_active' => true,
            'checkin' => $request->checkin,
            'checkin_instructions' => $request->checkin_instructions,
            'checkout' => $request->checkout,
            'checkout_instructions' => $request->checkout_instructions,
            'welcome_title' => $request->welcome_title,
            'welcome_message' => $request->welcome_message,
            'amenities_description' => $request->amenities_description,
            'location_area' => $request->location_area,
            'location_country' => $request->location_country,
            'google_map_url' => html_entity_decode($request->google_map_url),
            'location_description' => $request->location_description,
            'property_directions' => $request->property_directions,
        ];
    }

    protected function handleSettings(Property $property, Request $request): void
    {
        $property->settings()->updateOrCreate([], [
            'primary_color' => $request->input('settings.primary_color'),
            'secondary_color' => $request->input('settings.secondary_color'),
        ]);
    }

    protected function handleReview(Property $property, Request $request): void
    {
        if ($request->filled('review.description') || $request->filled('review.url')) {
            $property->review()->updateOrCreate([], [
                'description' => $request->input('review.description'),
                'url' => $request->input('review.url'),
            ]);
        }
    }

    protected function handleBeforeYouGo(Property $property, Request $request): void
    {
        $content = $request->input('before_you_go.content');
        if ($content) {
            $property->beforeYouGo()->updateOrCreate([], [
                'content' => $content,
            ]);
        }
    }

    public function syncExtras(Property $property, Request $request): void
    {
        $property->rules()->delete();
        foreach ($request->input('rules', []) as $rule) {
            $property->rules()->create($rule);
        }

        $property->faqs()->delete();
        foreach ($request->input('faqs', []) as $faq) {
            $property->faqs()->create($faq);
        }

        $wifi = $request->input('wifi');
        if ($wifi) {
            $property->wifi()->updateOrCreate([], $wifi);
        }

        $property->transportation()->delete();
        foreach ($request->input('transportation', []) as $item) {
            $property->transportation()->create($item);
        }

        $property->recommendations()->sync($request->input('recommendation_ids', []));
    }

    public function deleteGalleryImage(Property $property, string $imageId): void
    {
        $image = $property->images()->findOrFail($imageId);

        if ($image->public_id) {
            app(Cloudinary::class)->uploadApi()->destroy($image->public_id);
        }

        $image->delete();
    }

    /**
     * Delete all editor images for a property (useful when deleting property)
     */
    public function deleteAllEditorImages(Property $property): void
    {
        $editorImages = EditorImage::where('imageable_type', Property::class)
            ->where('imageable_id', $property->id)
            ->get();

        foreach ($editorImages as $image) {
            try {
                $image->deleteWithCloudinary();
            } catch (\Exception $e) {
                Log::error('Failed to delete editor image during property deletion', [
                    'property_id' => $property->id,
                    'image_id' => $image->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }
}
