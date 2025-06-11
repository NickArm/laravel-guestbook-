<?php

namespace App\Livewire\PropertySections;

use App\Models\Property;
use App\Traits\EnabledPages;
use Livewire\Component;

class CheckinSection extends Component
{
    use EnabledPages;

    public Property $property;

    public $enabled = false;

    public $check_in_time = '';

    public $check_in_instructions = '';

    public $check_out_time = '';

    public $check_out_instructions = '';

    protected $rules = [
        'enabled' => 'boolean',
        'check_in_time' => 'nullable|string|max:255',
        'check_in_instructions' => 'nullable|string',
        'check_out_time' => 'nullable|string|max:255',
        'check_out_instructions' => 'nullable|string',
    ];

    public function mount(Property $property)
    {
        $this->property = $property;
        $this->enabled = $this->isSectionEnabled('checkin');

        // Load existing data - based on your Property model fields
        $this->check_in_time = $property->checkin ?? '';
        $this->check_in_instructions = $property->checkin_instructions ?? '';
        $this->check_out_time = $property->checkout ?? '';
        $this->check_out_instructions = $property->checkout_instructions ?? '';
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'enabled') {
            $this->updateEnabledState('checkin', $this->enabled);
            session()->flash('message', 'Check In/Out section '.($this->enabled ? 'enabled' : 'disabled').' successfully!');

            return;
        }

        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        // Update property with the existing field names from your model
        $this->property->update([
            'checkin' => $this->check_in_time,
            'checkin_instructions' => $this->check_in_instructions,
            'checkout' => $this->check_out_time,
            'checkout_instructions' => $this->check_out_instructions,
        ]);

        // Update enabled state
        $this->updateEnabledState('checkin', $this->enabled);

        session()->flash('message', 'Check In/Out section saved successfully!');
    }

    public function render()
    {
        return view('livewire.property-sections.checkin-section');
    }
}
