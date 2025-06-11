<?php

namespace App\Livewire\PropertySections;

use App\Models\Property;
use App\Traits\EnabledPages;
use Livewire\Component;

class LocationSection extends Component
{
    use EnabledPages;

    public Property $property;

    public $enabled = false;

    public $location_area = '';

    public $location_country = '';

    public $google_map_url = '';

    public $location_description = '';

    protected $rules = [
        'enabled' => 'boolean',
        'location_area' => 'nullable|string|max:255',
        'location_country' => 'nullable|string|max:255',
        'google_map_url' => 'nullable|url|max:1000',
        'location_description' => 'nullable|string',
    ];

    public function mount(Property $property)
    {
        $this->property = $property;
        $this->enabled = $this->isSectionEnabled('location');

        // Load existing data from property
        $this->location_area = $property->location_area ?? '';
        $this->location_country = $property->location_country ?? '';
        $this->google_map_url = $property->google_map_url ?? '';
        $this->location_description = $property->location_description ?? '';
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'enabled') {
            $this->updateEnabledState('location', $this->enabled);
            session()->flash('message', 'Location section '.($this->enabled ? 'enabled' : 'disabled').' successfully!');

            return;
        }

        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        // Update property with location information
        $this->property->update([
            'location_area' => $this->location_area,
            'location_country' => $this->location_country,
            'google_map_url' => $this->google_map_url,
            'location_description' => $this->location_description,
        ]);

        // Update enabled state
        $this->updateEnabledState('location', $this->enabled);

        session()->flash('message', 'Location section saved successfully!');
    }

    public function render()
    {
        return view('livewire.property-sections.location-section');
    }
}
