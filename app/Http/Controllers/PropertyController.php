<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Services\PropertyService;
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
        $property = new Property;

        return view('properties.create', compact('property'));
    }

    public function edit(Property $property)
    {
        $this->authorize('update', $property);
        $property->load(['rules', 'faqs', 'wifi', 'transportation']);

        return view('properties.edit', compact('property'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|regex:/^[a-z0-9\-]+$/|unique:properties',
            'address' => 'nullable|string|max:255',
        ]);

        $user = auth()->user();

        $property = $user->properties()->create([
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
        ]);

        $this->propertyService->syncExtras($property, $request);

        return redirect()->route('dashboard')->with('success', 'Property created!');
    }

    public function update(Request $request, Property $property)
    {
        $this->authorize('update', $property);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|regex:/^[a-z0-9\-]+$/|unique:properties,slug,'.$property->id,
            'address' => 'nullable|string|max:255',
            'checkin' => 'nullable',
            'checkin_instructions' => 'nullable',
            'checkout' => 'nullable',
            'checkout_instructions' => 'nullable',
            'welcome_title' => 'nullable',
            'welcome_message' => 'nullable',
            'amenities_description' => 'nullable',
            'location_area' => 'nullable',
            'location_country' => 'nullable',
            'google_map_url' => 'nullable|url',
            'location_description' => 'nullable',
            'wifi.network' => 'nullable|string|max:255',
            'wifi.password' => 'nullable|string|max:255',
            'wifi.description' => 'nullable|string',
        ], [
            'slug.regex' => 'The slug must only contain lowercase letters, numbers, and hyphens.',
        ]);

        $property->update($validated);
        $property->update([
            'enabled_pages' => $request->input('enabled_pages', []),
        ]);

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
}
