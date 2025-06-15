<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;

class PropertyApiController extends Controller
{
    public function show($slug)
    {
        $property = Property::with([
            'rules',
            'faqs',
            'wifi',
            'transportation',
            'images',
            'recommendations.category',
            'appliances.images', // 👈 Added appliances with images
        ])->where('slug', $slug)->firstOrFail();

        $user = $property->user;

        if (! $user->is_active) {
            return response()->json(['message' => 'Owner account is deactivated.'], 403);
        }

        return response()->json([
            'property' => [
                'id' => $property->id,
                'slug' => $property->slug,
                'name' => $property->name,
                'logo_url' => $property->logo_url,
                'gallery' => $property->images->pluck('url')->toArray(), // 👈 This is the gallery
                'enabled_pages' => $property->enabled_pages,
                'address' => $property->address,
                'property_directions' => $property->property_directions,
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
                'faq' => $property->faqs->map(fn ($faq) => [
                    'question' => $faq->question,
                    'answer' => $faq->answer,
                ]),
                'wifi' => $property->wifi ? [
                    'network' => $property->wifi->network,
                    'password' => $property->wifi->password,
                    'description' => $property->wifi->description,
                ] : null,
                'transportation' => $property->transportation->map(fn ($t) => [
                    'title' => $t->title,
                    'description' => $t->description,
                ]),
                'appliances' => $property->appliances->map(fn ($appliance) => [
                    'id' => $appliance->id,
                    'title' => $appliance->title,
                    'description' => $appliance->description,
                    'video_url' => $appliance->video_url,
                    'images' => $appliance->images->pluck('url')->toArray(),
                ]),
                'before_you_go' => $property->beforeYouGoNotes->map(fn ($note) => [
                    'id' => $note->id,
                    'content' => $note->content,
                ]),

                'recommendations' => $property->recommendations->map(fn ($rec) => [
                    'id' => $rec->id,
                    'title' => $rec->title,
                    'image_url' => $rec->image_url,
                    'description' => $rec->description,
                    'website_url' => $rec->website_url,
                    'directions_url' => $rec->directions_url,
                    'category' => $rec->category->name ?? null,
                ]),
                'owner' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'photo' => $user->photo ?? '',
                    'message' => $user->bio ?? '',
                    'contacts' => collect($user->contact_me)->map(function ($contact) {
                        $icons = [
                            'instagram' => 'fa-brands fa-instagram',
                            'email' => 'fa-solid fa-envelope',
                            'phone' => 'fa-solid fa-phone',
                            'whatsapp' => 'fa-brands fa-whatsapp',
                            'viber' => 'fa-brands fa-viber',
                            'website' => 'fa-solid fa-globe',
                        ];

                        $colors = [
                            'whatsapp' => 'text-green-500',
                            'viber' => 'text-purple-500',
                        ];

                        return [
                            'type' => $contact['type'],
                            'value' => $contact['value'],
                            'icon' => $icons[$contact['type']] ?? 'fa-solid fa-circle',
                            'url' => $contact['url'] ?? match ($contact['type']) {
                                'whatsapp' => 'https://wa.me/'.preg_replace('/\D/', '', $contact['value']),
                                'viber' => 'viber://chat?number='.preg_replace('/\D/', '', $contact['value']),
                                'email' => 'mailto:'.$contact['value'],
                                'website' => 'https://'.ltrim($contact['value'], 'https://'),
                                default => null
                            },
                            'color' => $colors[$contact['type']] ?? null,
                        ];
                    })->values(),
                ],
                'review' => $property->review ? [
                    'description' => $property->review->description,
                    'url' => $property->review->url,
                ] : null,
                'settings' => [
                    'primary_color' => $property->settings->primary_color ?? '#000000',
                    'secondary_color' => $property->settings->secondary_color ?? '#ffffff',
                ],
            ],
        ]);
    }
}
