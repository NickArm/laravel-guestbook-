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
            'google_map_url' => $request->google_map_url,
            'location_description' => $request->location_description,
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
