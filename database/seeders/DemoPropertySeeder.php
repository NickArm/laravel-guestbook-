<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\Transportation;
use App\Models\User;
use App\Models\Wifi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoPropertySeeder extends Seeder
{
    public function run(): void
    {
        // Δημιουργία απλού χρήστη για το Property
        $user = User::firstOrCreate([
            'email' => 'lia@guesthouse.com',
        ], [
            'name' => 'Lia Armeni',
            'password' => Hash::make('password'),
            'is_active' => true,
        ]);

        // Δημιουργία property για τον χρήστη
        $property = $user->properties()->create([
            'name' => "Lia's Apartment",
            'slug' => 'lias-apartment',
            'address' => 'Potamos, Corfu, 49100',
            'enabled_pages' => [
                'amenities', 'location', 'owners', 'wifi', 'contact',
                'faq', 'rules', 'informations', 'blog', 'places-to-eat', 'before-you-go',
            ],
            'is_active' => true,
            'checkin' => '15:00',
            'checkin_instructions' => 'You will receive a code...',
            'checkout' => '11:00',
            'checkout_instructions' => 'If you’d like to request...',
            'welcome_title' => 'Hello and welcome to my home!!',
            'welcome_message' => 'My name is Lia and I’m beyond excited...',
            'amenities_description' => '<ul><li>Wifi</li><li>Smart TV</li></ul>',
            'location_area' => 'POTAMOS, CORFU',
            'location_country' => '49100, GREECE',
            'google_map_url' => 'https://maps.google.com/example',
            'location_description' => 'A beautiful apartment near Corfu...',
        ]);

        // Rules
        $rules = [
            ['title' => 'NO SMOKING', 'description' => 'Please no smoking or vaping.'],
            ['title' => 'NO PETS', 'description' => 'Pets are not allowed.'],
        ];
        foreach ($rules as $rule) {
            $property->rules()->create($rule);
        }

        // FAQs
        $faqs = [
            ['question' => 'Check-in time?', 'answer' => 'From 15:00 onward.'],
            ['question' => 'WiFi password?', 'answer' => 'See the wifi section.'],
        ];
        foreach ($faqs as $faq) {
            $property->faqs()->create($faq);
        }

        // Wifi
        $property->wifi()->create([
            'network' => 'liasapartment',
            'password' => 'wifi password',
            'description' => 'Available in all rooms.',
        ]);

        // Transportation
        $property->transportation()->create([
            'title' => 'Taxi',
            'description' => 'Call 12345 or book online.',
        ]);
    }
}
