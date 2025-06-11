<?php

namespace App\Livewire\PropertySections;

use App\Models\Property;
use App\Traits\EnabledPages;
use Livewire\Component;

class AmenitiesSection extends Component
{
    use EnabledPages;

    public Property $property;

    public $enabled = false;

    public $description = '';

    protected $rules = [
        'description' => 'nullable|string',
    ];

    public function mount(Property $property)
    {
        $this->property = $property;
        $this->enabled = $this->isSectionEnabled('amenities');
        $this->description = old('amenities_description', $property->amenities_description ?? '');

        $this->dispatch('init-ckeditor-amenities');
    }

    public function updated($propertyName)
    {
        if ($propertyName !== 'description') {
            $this->dispatch('init-ckeditor-amenities');
        }
    }

    public function updatedEnabled()
    {
        $this->updateEnabledState('amenities', $this->enabled);
    }

    public function save()
    {
        // Χρήση JavaScript για να πάρουμε το content
        $this->js('
            if (CKEDITOR.instances["amenities_editor"]) {
                const content = CKEDITOR.instances["amenities_editor"].getData();
                $wire.set("description", content);
                $wire.call("performSave");
            } else {
                $wire.call("performSave");
            }
        ');
    }

    public function performSave()
    {
        $this->validate();

        $this->property->update([
            'amenities_description' => $this->description,
        ]);

        $this->property->refresh();
        session()->flash('message', 'Amenities updated successfully!');
    }

    public function render()
    {
        return view('livewire.property-sections.amenities-section');
    }
}
