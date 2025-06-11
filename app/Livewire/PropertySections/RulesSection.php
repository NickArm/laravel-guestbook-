<?php

namespace App\Livewire\PropertySections;

use App\Models\Property;
use App\Models\Rule;
use App\Traits\EnabledPages;
use Livewire\Component;

class RulesSection extends Component
{
    use EnabledPages;

    public Property $property;

    public $enabled = false;

    public $showModal = false;

    public $editingId = null;

    // Modal form fields
    public $title = '';

    public $description = '';

    protected $rules = [
        'enabled' => 'boolean',
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:1000',
    ];

    public function mount(Property $property)
    {
        $this->property = $property;
        $this->enabled = $this->isSectionEnabled('rules');
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'enabled') {
            $this->updateEnabledState('rules', $this->enabled);
            session()->flash('message', 'Rules section '.($this->enabled ? 'enabled' : 'disabled').' successfully!');

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

    public function editRule($ruleId)
    {
        $rule = $this->property->rules()->findOrFail($ruleId);
        $this->editingId = $ruleId;
        $this->title = $rule->title;
        $this->description = $rule->description;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'property_id' => $this->property->id,
        ];

        if ($this->editingId) {
            // Update existing rule
            $this->property->rules()->where('id', $this->editingId)->update($data);
            $message = 'Rule updated successfully!';
        } else {
            // Create new rule
            $this->property->rules()->create($data);
            $message = 'Rule added successfully!';
        }

        $this->closeModal();
        $this->property->refresh();

        session()->flash('message', $message);
    }

    public function deleteRule($ruleId)
    {
        $this->property->rules()->where('id', $ruleId)->delete();
        $this->property->refresh();

        session()->flash('message', 'Rule deleted successfully!');
    }

    public function render()
    {
        return view('livewire.property-sections.rules-section');
    }
}
