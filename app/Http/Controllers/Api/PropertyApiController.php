<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;

class PropertyApiController extends Controller
{
    public function show($slug)
    {
        $property = Property::where('slug', $slug)->firstOrFail();

        return response()->json([
            'property' => [
                'id' => $property->id,
                'slug' => $property->slug,
                'name' => $property->name,
                'enabled_pages' => $property->enabled_pages,
                'address' => $property->address,
                'checkin' => $property->checkin,
                'checkin_instructions' => $property->checkin_instructions,
                'checkout' => $property->checkout,
                'checkout_instructions' => $property->checkout_instructions,
                'welcome_title' => $property->welcome_title,
                'welcome_message' => $property->welcome_message,
                'amenities_description' => $property->amenities_description,
                'location_area' => $property->location_area,
                'location_country' => $property->location_country,
                'google_map_url' => $property->google_map_url,
                'location_description' => $property->location_description,
                'rules' => $property->rules->map(fn ($rule) => [
                    'title' => $rule->title,
                    'description' => $rule->description,
                ]),
            ],
        ]);
    }
}
