<?php

namespace App\Services;

use App\Models\Property;
use App\Models\User;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PropertyService
{
    public function createFullProperty(User $user, Request $request): Property
    {
        $this->validateProperty($request);

        $property = $user->properties()->create($this->buildPropertyData($request));

        $this->handleSettings($property, $request);
        $this->handleReview($property, $request);
        $this->handleLogoUpload($property, $request);
        $this->handleGalleryUpload($property, $request);
        $this->syncExtras($property, $request);

        return $property;
    }

    public function updateFullProperty(Property $property, Request $request): void
    {
        $this->validateProperty($request, $property->id);

        $property->update($this->buildPropertyData($request));

        $this->handleSettings($property, $request);
        $this->handleReview($property, $request);
        $this->handleLogoUpload($property, $request);
        $this->handleGalleryUpload($property, $request);
        $this->syncExtras($property, $request);
    }

    public function deleteGalleryImage(Property $property, $imageId): void
    {
        $image = $property->images()->findOrFail($imageId);

        if ($image->public_id) {
            app(Cloudinary::class)->uploadApi()->destroy($image->public_id);
        }

        $image->delete();
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

    protected function handleLogoUpload(Property $property, Request $request): void
    {
        if (! $request->hasFile('logo')) {
            return;
        }

        $upload = app(Cloudinary::class)->uploadApi()->upload(
            $request->file('logo')->getRealPath(),
            [
                'folder' => 'properties/'.$property->slug,
                'public_id' => 'logo',
                'overwrite' => true,
            ]
        );

        $property->update(['logo_url' => $upload['secure_url']]);
    }

    protected function handleGalleryUpload(Property $property, Request $request): void
    {
        if (! $request->hasFile('gallery')) {
            return;
        }

        $existingCount = $property->images()->count();
        $newImages = $request->file('gallery');

        if (($existingCount + count($newImages)) > 10) {
            abort(422, 'You can upload up to 10 images in total.');
        }

        foreach ($newImages as $image) {
            $upload = app(Cloudinary::class)->uploadApi()->upload(
                $image->getRealPath(),
                [
                    'folder' => 'properties/'.$property->slug.'/gallery',
                    'use_filename' => true,
                    'unique_filename' => false,
                ]
            );

            $property->images()->create([
                'url' => $upload['secure_url'],
                'public_id' => $upload['public_id'],
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
}
