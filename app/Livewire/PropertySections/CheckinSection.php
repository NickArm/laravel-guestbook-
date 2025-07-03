<?php

namespace App\Livewire\PropertySections;

use App\Models\Checkflow;
use App\Models\Property;
use App\Traits\EnabledPages;
use Livewire\Component;

class CheckinSection extends Component
{
    use EnabledPages;

    public Property $property;

    public Checkflow $checkflow;

    public $enabled = false;

    public $check_in_time = '';

    public $check_in_instructions = '';

    public $check_out_time = '';

    public $check_out_instructions = '';

    public $checkin_video = '';

    public $checkout_video = '';

    protected $rules = [
        'enabled' => 'boolean',
        'check_in_time' => 'nullable|string|max:255',
        'check_in_instructions' => 'nullable|string',
        'check_out_time' => 'nullable|string|max:255',
        'check_out_instructions' => 'nullable|string',
        'checkin_video' => ['nullable', 'regex:/^https:\/\/(www\.)?youtube\.com\/watch\?v=.+$/'],
        'checkout_video' => ['nullable', 'regex:/^https:\/\/(www\.)?youtube\.com\/watch\?v=.+$/'],
    ];

    public function mount(Property $property)
    {
        $this->property = $property;
        $this->enabled = $this->isSectionEnabled('checkin');

        $this->checkflow = $property->checkflow()->firstOrNew();

        $this->check_in_time = $this->checkflow->checkin ?? '';
        $this->check_in_instructions = $this->checkflow->checkin_instructions ?? '';
        $this->check_out_time = $this->checkflow->checkout ?? '';
        $this->check_out_instructions = $this->checkflow->checkout_instructions ?? '';
        $this->checkin_video = $this->checkflow->checkin_video ?? '';
        $this->checkout_video = $this->checkflow->checkout_video ?? '';
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

        $this->checkflow->fill([
            'checkin' => $this->check_in_time,
            'checkin_instructions' => $this->check_in_instructions,
            'checkout' => $this->check_out_time,
            'checkout_instructions' => $this->check_out_instructions,
            'checkin_video' => $this->checkin_video,
            'checkout_video' => $this->checkout_video,
        ]);

        $this->property->checkflow()->save($this->checkflow);

        $this->updateEnabledState('checkin', $this->enabled);

        session()->flash('message', 'Check In/Out section saved successfully!');
    }

    public function render()
    {
        return view('livewire.property-sections.checkin-section');
    }
}
