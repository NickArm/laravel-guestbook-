<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Services\PropertyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();

        if ($user->properties()->count() >= $user->property_limit) {
            return back()->with('error', 'You have reached your property creation limit.');
        }

        $property = $this->propertyService->createFullProperty($user, $request);

        return redirect()->route('dashboard')->with('success', 'Property created!');
    }

    public function update(Request $request, Property $property)
    {
        $this->authorize('update', $property);

        $this->propertyService->updateFullProperty($property, $request);

        return redirect()->route('properties.edit', $property)->with('success', 'Property updated!');
    }

    public function destroy(Property $property)
    {
        $this->authorize('delete', $property);
        $property->delete();

        return redirect()->route('dashboard')->with('success', 'Property deleted!');
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

        $this->propertyService->deleteGalleryImage($property, $imageId);

        return response()->json(['message' => 'Image deleted'], 200);
    }
}
