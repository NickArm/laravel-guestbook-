<?php

namespace App\Services;

use App\Actions\UploadGalleryImagesAction;
use App\Actions\UploadLogoAction;
use App\Models\Property;
use App\Models\User;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;
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

        return $property;
    }

    public function updateFullProperty(Property $property, Request $request): void
    {
        $this->validateProperty($request, $property->id, true); // Added isUpdate flag

        $property->update($this->buildPropertyData($request, true)); // Added isUpdate flag

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
    }

    protected function validateProperty(Request $request, $id = null, bool $isUpdate = false): void
    {
        $rules = [
            // Required fields from Home tab only
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'welcome_title' => 'required|string|max:255',
            'welcome_message' => 'required|string|max:2000',
            'property_directions' => 'nullable|url',

            // All other fields are optional for initial creation
            'checkin' => 'nullable|string',
            'checkout' => 'nullable|string',
            'checkin_instructions' => 'nullable|string',
            'checkout_instructions' => 'nullable|string',
            'location_area' => 'nullable|string|max:255',
            'location_country' => 'nullable|string|max:255',
            'location_description' => 'nullable|string',
            'google_map_url' => 'nullable|url',
            'amenities_description' => 'nullable|string',
        ];

        // Only validate slug during creation AND only if provided
        if (! $isUpdate && $request->filled('slug')) {
            $rules['slug'] = 'string|regex:/^[a-z0-9\-]+$/|unique:properties,slug,'.$id;
        }

        $messages = [
            'name.required' => 'Property name is required.',
            'address.required' => 'Property address is required.',
            'welcome_title.required' => 'Welcome title is required.',
            'welcome_message.required' => 'Welcome message is required.',
            'slug.regex' => 'The slug must only contain lowercase letters, numbers, and hyphens.',
            'slug.unique' => 'This slug is already taken. Please choose a different one.',
            'property_directions.url' => 'Please enter a valid URL for directions.',
            'google_map_url.url' => 'Please enter a valid URL for Google Maps.',
        ];

        $request->validate($rules, $messages);
    }

    protected function buildPropertyData(Request $request, bool $isUpdate = false): array
    {
        $data = [
            // Required Home tab fields
            'name' => $request->name,
            'address' => $request->address,
            'welcome_title' => $request->welcome_title,
            'welcome_message' => $request->welcome_message,
            'property_directions' => $request->property_directions,

            // Optional fields that might be filled later
            'enabled_pages' => $request->input('enabled_pages', []),
            'is_active' => true,
            'checkin' => $request->checkin,
            'checkin_instructions' => $request->checkin_instructions,
            'checkout' => $request->checkout,
            'checkout_instructions' => $request->checkout_instructions,
            'amenities_description' => $request->amenities_description,
            'location_area' => $request->location_area,
            'location_country' => $request->location_country,
            'google_map_url' => $request->google_map_url ? html_entity_decode($request->google_map_url) : null,
            'location_description' => $request->location_description,
        ];

        // Only set slug during creation (model will auto-generate if empty)
        if (! $isUpdate) {
            $data['slug'] = $request->filled('slug') ?
                Str::slug($request->slug) :
                null; // Let model auto-generate from name
        }
        // During update, slug is excluded and protected by model

        return $data;
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
}
