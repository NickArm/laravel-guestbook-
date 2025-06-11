<?php

namespace App\Livewire\PropertySections;

use App\Models\Property;
use App\Models\Wifi;
use App\Traits\EnabledPages;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class WifiSection extends Component
{
    use EnabledPages;

    public Property $property;

    public $enabled = false;

    public $wifi_network = '';

    public $wifi_password = '';

    public $wifi_description = '';

    protected $rules = [
        'enabled' => 'boolean',
        'wifi_network' => 'nullable|string|max:255',
        'wifi_password' => 'nullable|string|max:255',
        'wifi_description' => 'nullable|string',
    ];

    public function mount(Property $property)
    {
        $this->property = $property;
        $this->enabled = $this->isSectionEnabled('wifi');

        // Load existing WiFi data from the wifi relationship
        $wifi = $property->wifi;
        if ($wifi) {
            $this->wifi_network = $wifi->network ?? '';
            $this->wifi_password = $wifi->password ?? '';
            $this->wifi_description = $wifi->description ?? '';
        }
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'enabled') {
            $this->updateEnabledState('wifi', $this->enabled);
            session()->flash('message', 'WiFi section '.($this->enabled ? 'enabled' : 'disabled').' successfully!');

            return;
        }

        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        try {
            // Update or create WiFi record
            $this->property->wifi()->updateOrCreate(
                ['property_id' => $this->property->id],
                [
                    'network' => $this->wifi_network,
                    'password' => $this->wifi_password,
                    'description' => $this->wifi_description,
                ]
            );

            // Update enabled state
            $this->updateEnabledState('wifi', $this->enabled);

            // Refresh property to see changes
            $this->property->refresh();

            session()->flash('message', 'WiFi section saved successfully!');

        } catch (\Exception $e) {
            Log::error('WiFi Section Save Error:', ['error' => $e->getMessage()]);
            session()->flash('error', 'Error saving WiFi section: '.$e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.property-sections.wifi-section');
    }
}
