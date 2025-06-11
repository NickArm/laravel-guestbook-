<?php

namespace App\Livewire\PropertySections;

use App\Models\Property;
use App\Traits\EnabledPages;
use Livewire\Component;

class FaqSection extends Component
{
    use EnabledPages;

    public Property $property;

    public $enabled = false;

    public $showModal = false;

    public $editingId = null;

    public $question = '';

    public $answer = '';

    protected $rules = [
        'enabled' => 'boolean',
        'question' => 'required|string|max:255',
        'answer' => 'required|string|max:1000',
    ];

    public function mount(Property $property)
    {
        $this->property = $property;
        $this->enabled = $this->isSectionEnabled('faq');
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'enabled') {
            $this->updateEnabledState('faq', $this->enabled);
            session()->flash('message', 'FAQ section '.($this->enabled ? 'enabled' : 'disabled').' successfully!');

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
        $this->question = '';
        $this->answer = '';
        $this->editingId = null;
        $this->resetValidation();
    }

    public function editFaq($id)
    {
        $faq = $this->property->faqs()->findOrFail($id);
        $this->editingId = $faq->id;
        $this->question = $faq->question;
        $this->answer = $faq->answer;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'question' => $this->question,
            'answer' => $this->answer,
            'property_id' => $this->property->id,
        ];

        if ($this->editingId) {
            $this->property->faqs()->where('id', $this->editingId)->update($data);
            $message = 'FAQ updated successfully!';
        } else {
            $this->property->faqs()->create($data);
            $message = 'FAQ created successfully!';
        }

        $this->closeModal();
        $this->property->refresh();
        session()->flash('message', $message);
    }

    public function deleteFaq($id)
    {
        $this->property->faqs()->where('id', $id)->delete();
        $this->property->refresh();
        session()->flash('message', 'FAQ deleted successfully!');
    }

    public function render()
    {
        return view('livewire.property-sections.faq-section');
    }
}
