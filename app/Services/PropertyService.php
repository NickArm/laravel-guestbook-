<?php

namespace App\Services;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PropertyService
{
    public function syncExtras(Property $property, Request $request): void
    {
        // Sync Rules
        $property->rules()->delete();
        foreach ($request->input('rules', []) as $rule) {
            $property->rules()->create($rule);
        }

        // Sync FAQs
        $property->faqs()->delete();
        foreach ($request->input('faqs', []) as $faq) {
            $property->faqs()->create($faq);
        }

        // Sync Wifi
        $wifi = $request->input('wifi');
        if ($wifi) {
            $property->wifi()->updateOrCreate([], $wifi);
        }

        // Sync Transportation
        $property->transportation()->delete();
        foreach ($request->input('transportation', []) as $item) {
            $property->transportation()->create($item);
        }
    }

    public function updateProperty(Property $property, array $data): void
    {
        $property->update(Arr::except($data, ['rules', 'faqs', 'wifi', 'transportation']));

        $property->update([
            'enabled_pages' => $data['enabled_pages'] ?? [],
        ]);

        $property->rules()->delete();
        foreach ($data['rules'] ?? [] as $rule) {
            $property->rules()->create($rule);
        }

        $property->faqs()->delete();
        foreach ($data['faqs'] ?? [] as $faq) {
            $property->faqs()->create($faq);
        }

        $property->transportation()->delete();
        foreach ($data['transportation'] ?? [] as $item) {
            $property->transportation()->create($item);
        }

        if (! empty($data['wifi'])) {
            $property->wifi()->updateOrCreate([], $data['wifi']);
        }
    }

    public function createProperty(Property $property, array $data): void
    {
        $this->updateProperty($property, $data);
    }
}
