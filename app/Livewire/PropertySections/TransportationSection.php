<?php

namespace App\Livewire\PropertySections;

use App\Models\Property;
use App\Traits\EnabledPages;
use Livewire\Component;

class TransportationSection extends Component
{
    use EnabledPages;

    public Property $property;

    public $enabled = false;

    public $showModal = false;

    public $editingId = null;

    public $title = '';

    public $description = '';

    public $url = '';

    protected $rules = [
        'enabled' => 'boolean',
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:1000',
        'url' => 'nullable|url|max:500',
    ];

    public function mount(Property $property)
    {
        $this->property = $property;
        $this->enabled = $this->isSectionEnabled('transportation');
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'enabled') {
            $this->updateEnabledState('transportation', $this->enabled);
            session()->flash('message', 'Transportation section '.($this->enabled ? 'enabled' : 'disabled').' successfully!');

            return;
        }

        $this->validateOnly($propertyName);
    }

    public function openModal()
    {
        $this->showModal = true;
        $this->resetForm();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->title = '';
        $this->description = '';
        $this->editingId = null;
        $this->resetValidation();
    }

    public function editTransportation($transportationId)
    {
        $transportation = $this->property->transportation()->findOrFail($transportationId);
        $this->editingId = $transportationId;
        $this->title = $transportation->title;
        $this->description = $transportation->description;
        $this->url = $transportation->url;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'url' => $this->url,
            'property_id' => $this->property->id,

        ];

        if ($this->editingId) {
            $this->property->transportation()->where('id', $this->editingId)->update($data);
            $message = 'Transportation updated successfully!';
        } else {
            $this->property->transportation()->create($data);
            $message = 'Transportation added successfully!';
        }

        $this->closeModal();
        $this->property->refresh();

        session()->flash('message', $message);
    }

    public function deleteTransportation($transportationId)
    {
        $this->property->transportation()->where('id', $transportationId)->delete();
        $this->property->refresh();

        session()->flash('message', 'Transportation deleted successfully!');
    }

    public function render()
    {
        return view('livewire.property-sections.transportation-section');
    }
}
