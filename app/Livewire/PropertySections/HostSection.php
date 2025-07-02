<?php

namespace App\Livewire\PropertySections;

use App\Actions\UploadHostPhotoAction;
use App\Models\Property;
use App\Traits\EnabledPages;
use Cloudinary\Cloudinary;
use Livewire\Component;
use Livewire\WithFileUploads;

class HostSection extends Component
{
    use EnabledPages, WithFileUploads;

    public Property $property;

    public $enabled = false;

    public $name = '';

    public $photo = '';

    public $photoFile;

    public $message = '';

    public $contacts = [];

    protected $rules = [
        'enabled' => 'boolean',
        'name' => 'required|string|max:255',
        'photoFile' => 'nullable|image|max:2048',
        'message' => 'nullable|string|max:2000',
        'contacts' => 'nullable|array',
        'contacts.*.type' => 'required_with:contacts.*.value|string|max:50',
        'contacts.*.value' => 'required_with:contacts.*.type|string|max:255',
    ];

    public function mount(Property $property)
    {
        $this->property = $property;
        $this->enabled = $this->isSectionEnabled('host');

        if ($this->property->host) {
            $this->name = $this->property->host->name;
            $this->photo = $this->property->host->photo;
            $this->message = $this->property->host->message;
            $this->contacts = $this->property->host->contacts ?? [];
        } else {
            $this->contacts = [['type' => '', 'value' => '']];
        }
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'enabled') {
            $this->updateEnabledState('host', $this->enabled);
            session()->flash('message', 'Host section '.($this->enabled ? 'enabled' : 'disabled').' successfully!');

            return;
        }

        $this->validateOnly($propertyName);
    }

    public function addContactMethod()
    {
        $this->contacts[] = ['type' => '', 'value' => ''];
    }

    public function removeContactMethod($index)
    {
        unset($this->contacts[$index]);
        $this->contacts = array_values($this->contacts);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'photoFile' => 'nullable|image|max:2048',
            'message' => 'nullable|string|max:2000',
            'contacts' => 'nullable|array',
            'contacts.*.type' => 'required_with:contacts.*.value|string|max:50',
            'contacts.*.value' => 'required_with:contacts.*.type|string|max:255',
        ]);

        $host = $this->property->host()->firstOrNew([]);

        // Ανέβασμα νέας φωτογραφίας
        if ($this->photoFile) {
            // Διαγραφή παλιάς
            if ($host->public_id) {
                app(Cloudinary::class)->uploadApi()->destroy($host->public_id);
            }

            // Νέο ανέβασμα
            $upload = app(UploadHostPhotoAction::class)->execute($this->property, $this->photoFile);

            $this->photo = $upload['url'];
            $host->photo = $upload['url'];
            $host->public_id = $upload['public_id'];
        }

        $host->name = $this->name;
        $host->message = $this->message;
        $host->contacts = $this->contacts;
        $host->save();

        session()->flash('message', 'Host saved successfully.');
    }

    public function render()
    {
        return view('livewire.property-sections.host-section');
    }
}
