<?php

namespace App\Http\Controllers;

use App\Models\Appliance;
use App\Models\Property;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;

class ApplianceController extends Controller
{
    public function store(Request $request, Property $property)
    {
        $validated = $request->validate([
            'appliance_title' => 'required|string|max:255',
            'appliance_description' => 'nullable|string',
            'appliance_video' => 'nullable|url|regex:/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+$/',
            'appliance_images.*' => 'nullable|image|max:8192',
        ]);

        $appliance = $property->appliances()->create([
            'title' => $validated['appliance_title'],
            'description' => $validated['appliance_description'] ?? '',
            'video_url' => $validated['appliance_video'] ?? null,
        ]);

        if ($request->hasFile('appliance_images')) {
            $cloudinary = app(Cloudinary::class);

            foreach ($request->file('appliance_images') as $image) {
                if (! $image->isValid()) {
                    continue;
                }

                $uploaded = $cloudinary->uploadApi()->upload(
                    $image->getRealPath(),
                    [
                        'folder' => "properties/{$property->slug}/appliances",
                        'resource_type' => 'image',
                    ]
                );

                $appliance->images()->create([
                    'url' => $uploaded['secure_url'],
                    'public_id' => $uploaded['public_id'],
                ]);
            }
        }

        return redirect()->back()->with('success', 'Appliance added successfully.');
    }

    public function edit(Property $property, Appliance $appliance)
    {
        $this->authorize('update', $property);

        return view('appliances.edit', compact('property', 'appliance'));
    }

    public function update(Request $request, Property $property, Appliance $appliance)
    {
        $validated = $request->validate([
            'appliance_title' => 'required|string|max:255',
            'appliance_description' => 'nullable|string',
            'appliance_video' => 'nullable|url|regex:/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+$/',
            'appliance_images.*' => 'nullable|image|max:8192',
        ]);

        $appliance->update([
            'title' => $validated['appliance_title'],
            'description' => $validated['appliance_description'] ?? '',
            'video_url' => $validated['appliance_video'] ?? null,
        ]);

        if ($request->hasFile('appliance_images')) {
            $cloudinary = app(Cloudinary::class);

            foreach ($request->file('appliance_images') as $image) {
                if (! $image->isValid()) {
                    continue;
                }

                $uploaded = $cloudinary->uploadApi()->upload(
                    $image->getRealPath(),
                    [
                        'folder' => "properties/{$property->slug}/appliances",
                        'resource_type' => 'image',
                    ]
                );

                $appliance->images()->create([
                    'url' => $uploaded['secure_url'],
                    'public_id' => $uploaded['public_id'],
                ]);
            }
        }

        return redirect()->back()->with('success', 'Appliance updated.');
    }

    public function destroy(Property $property, Appliance $appliance)
    {
        $this->authorize('update', $property);

        $cloudinary = app(Cloudinary::class);

        foreach ($appliance->images as $image) {
            if ($image->public_id) {
                $cloudinary->uploadApi()->destroy($image->public_id);
            }
            $image->delete();
        }

        $appliance->delete();

        return redirect()->back()->with('success', 'Appliance deleted.');
    }
}
