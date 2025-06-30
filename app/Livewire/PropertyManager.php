<?php

namespace App\Livewire;

use App\Models\Property;
use Livewire\Component;

class PropertyManager extends Component
{
    public Property $property;

    public $activeSection = 'home';

    protected $listeners = [
        'sectionSaved' => 'refreshProperty',
        'propertyCreated' => 'handlePropertyCreated',
    ];

    // Valid sections that can be navigated to
    protected $validSections = [
        'home',
        'checkin',
        'amenities',
        'appliances',
        'wifi',
        'location',
        'transportation',
        'rules',
        'faq',
        'host',
        'gallery',
        'review',
        'before-you-go',
        'recommendations',
        'settings',
    ];

    public function mount(?Property $property = null)
    {
        $this->property = $property ?? new Property;
    }

    public function setActiveSection($section)
    {
        // Validate that the section exists
        if (in_array($section, $this->validSections)) {
            $this->activeSection = $section;
        }
    }

    public function handlePropertyCreated($propertyId)
    {
        // Load the newly created property
        $this->property = Property::find($propertyId);

        session()->flash('message', 'Property created successfully!');
    }

    public function refreshProperty()
    {
        if ($this->property->exists) {
            $this->property->refresh();
        }

        session()->flash('message', 'Section saved successfully!');
    }

    public function render()
    {
        return view('livewire.property-manager');
    }
}
