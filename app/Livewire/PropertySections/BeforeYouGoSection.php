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

    public array $notes = [];

    protected $rules = [
        'notes.*.content' => 'nullable|string|max:2000',
    ];

    public function mount(Property $property)
    {
        $this->property = $property;
        $this->enabled = $this->isSectionEnabled('before_you_go');

        $this->notes = $property->beforeYouGoNotes->map(fn ($note) => ['id' => $note->id, 'content' => $note->content])->toArray();

        if (empty($this->notes)) {
            $this->notes[] = ['id' => null, 'content' => ''];
        }
    }

    public function updatedEnabled()
    {
        $this->updateEnabledState('before_you_go', $this->enabled);
    }

    public function addNote()
    {
        $this->notes[] = ['id' => null, 'content' => ''];
    }

    public function removeNote($index)
    {
        $note = $this->notes[$index];
        if (! empty($note['id'])) {
            BeforeYouGo::where('id', $note['id'])->delete();
        }
        unset($this->notes[$index]);
        $this->notes = array_values($this->notes);
    }

    public function save()
    {
        $this->validate();

        foreach ($this->notes as $note) {
            BeforeYouGo::updateOrCreate(
                ['id' => $note['id']],
                ['property_id' => $this->property->id, 'content' => $note['content']]
            );
        }

        session()->flash('message', 'Before You Go notes saved successfully.');
    }

    public function render()
    {
        return view('livewire.property-sections.before-you-go-section');
    }
}
