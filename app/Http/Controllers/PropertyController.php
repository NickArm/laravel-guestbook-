<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Services\PropertyService;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    protected PropertyService $propertyService;

    public function __construct(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
    }

    public function create()
    {
        return view('properties.create', ['property' => new Property]);
    }

    public function edit(Property $property)
    {
        $this->authorize('update', $property);
        $property->load(['rules', 'faqs', 'wifi', 'transportation', 'images']);

        return view('properties.edit', compact('property'));
    }

    public function store(Request $request)
    {
        $this->validateProperty($request);

        $property = auth()->user()->properties()->create($this->buildPropertyData($request));

        $property->settings()->create([
            'primary_color' => $request->input('settings.primary_color'),
            'secondary_color' => $request->input('settings.secondary_color'),
        ]);

        if ($request->filled('review.description') || $request->filled('review.url')) {
            $property->review()->updateOrCreate([], [
                'description' => $request->input('review.description'),
                'url' => $request->input('review.url'),
            ]);
        }

        $this->handleLogoUpload($request, $property);
        $this->handleGalleryUpload($request, $property);

        $this->propertyService->syncExtras($property, $request);

        return redirect()->route('dashboard')->with('success', 'Property created!');
    }

    public function update(Request $request, Property $property)
    {
        $this->authorize('update', $property);
        $this->validateProperty($request, $property->id);

        $property->update($this->buildPropertyData($request));

        $property->settings()->updateOrCreate([], [
            'primary_color' => $request->input('settings.primary_color'),
            'secondary_color' => $request->input('settings.secondary_color'),
        ]);

        if ($request->filled('review.description') || $request->filled('review.url')) {
            $property->review()->updateOrCreate([], [
                'description' => $request->input('review.description'),
                'url' => $request->input('review.url'),
            ]);
        }

        $this->handleLogoUpload($request, $property);
        $this->handleGalleryUpload($request, $property);

        $this->propertyService->syncExtras($property, $request);

        return redirect()->route('properties.edit', $property)->with('success', 'Property updated!');
    }

    public function destroy(Property $property)
    {
        $this->authorize('delete', $property);
        $property->delete();

        return redirect()->route('properties.index')->with('success', 'Property deleted!');
    }

    public function toggleActive(Property $property)
    {
        $this->authorize('update', $property);
        $property->update(['is_active' => ! $property->is_active]);

        return back()->with('success', 'Property status updated!');
    }

    public function deleteImage(Property $property, $imageId)
    {
        $this->authorize('update', $property);
        $image = $property->images()->findOrFail($imageId);

        if ($image->public_id) {
            app(Cloudinary::class)->uploadApi()->destroy($image->public_id);
        }

        $image->delete();

        return response()->json(['message' => 'Image deleted'], 200);
    }

    // -------------------------------
    // Helpers
    // -------------------------------

    protected function validateProperty(Request $request, $id = null)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|regex:/^[a-z0-9\-]+$/|unique:properties,slug,'.$id,
            'address' => 'nullable|string|max:255',
            'google_map_url' => 'nullable|url',
            'wifi.network' => 'nullable|string|max:255',
            'wifi.password' => 'nullable|string|max:255',
            'wifi.description' => 'nullable|string',
            'settings.primary_color' => 'nullable|string|starts_with:#|size:7',
            'settings.secondary_color' => 'nullable|string|starts_with:#|size:7',

        ];

        $request->validate($rules, [
            'slug.regex' => 'The slug must only contain lowercase letters, numbers, and hyphens.',
        ]);
    }

    protected function buildPropertyData(Request $request)
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

    protected function handleLogoUpload(Request $request, Property $property)
    {
        if ($request->hasFile('logo')) {
            $cloudinary = app(Cloudinary::class);

            $upload = $cloudinary->uploadApi()->upload(
                $request->file('logo')->getRealPath(),
                [
                    'folder' => 'properties/'.$property->slug,
                    'public_id' => 'logo',
                    'overwrite' => true,
                ]
            );

            $property->update(['logo_url' => $upload['secure_url']]);
        }
    }

    protected function handleGalleryUpload(Request $request, Property $property)
    {
        if (! $request->hasFile('gallery')) {
            return;
        }

        $existingCount = $property->images()->count();
        $newImages = $request->file('gallery');

        if (($existingCount + count($newImages)) > 10) {
            return back()->withErrors(['gallery' => 'You can upload up to 10 images in total.']);
        }

        $cloudinary = app(Cloudinary::class);

        foreach ($newImages as $image) {
            $upload = $cloudinary->uploadApi()->upload(
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
}
