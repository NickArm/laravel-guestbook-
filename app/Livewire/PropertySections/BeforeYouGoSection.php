<?php

namespace App\Livewire\PropertySections;

use App\Models\BeforeYouGo;
use App\Models\Property;
use App\Traits\EnabledPages;
use Livewire\Component;

class BeforeYouGoSection extends Component
{
    use EnabledPages;

    public Property $property;

    public $enabled = false;

    public $content = '';

    protected $rules = [
        'content' => 'nullable|string',
    ];

    public function mount(Property $property)
    {
        $this->property = $property;
        $this->enabled = $this->isSectionEnabled('before_you_go');

        $beforeYouGo = BeforeYouGo::where('property_id', $property->id)->first();
        $this->content = old('content', $beforeYouGo->content ?? '');

        $this->dispatch('init-ckeditor-before-you-go');
    }

    public function updated($propertyName)
    {
        if ($propertyName !== 'content') {
            $this->dispatch('init-ckeditor-before-you-go');
        }
    }

    public function updatedEnabled()
    {
        $this->updateEnabledState('before_you_go', $this->enabled);
    }

    public function save()
    {
        // Χρήση JavaScript για να πάρουμε το content
        $this->js('
            if (CKEDITOR.instances["before_you_go_editor"]) {
                const content = CKEDITOR.instances["before_you_go_editor"].getData();
                $wire.set("content", content);
                $wire.call("performSave");
            } else {
                $wire.call("performSave");
            }
        ');
    }

    public function performSave()
    {
        $this->validate();

        BeforeYouGo::updateOrCreate(
            ['property_id' => $this->property->id],
            ['content' => $this->content]
        );

        session()->flash('message', 'Before You Go updated successfully!');
    }

    public function render()
    {
        return view('livewire.property-sections.before-you-go-section');
    }
}
