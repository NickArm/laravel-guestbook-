<?php

namespace App\Livewire\PropertySections;

use App\Models\Property;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class HomeSection extends Component
{
    public $property;

    public $name;

    public $slug;

    public $address;

    public $welcome_title;

    public $property_directions;

    public $welcome_message;

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'welcome_title' => 'required|string|max:255',
            'welcome_message' => 'required|string|max:2000',
            'property_directions' => 'nullable|url|max:500',
        ];

        if (! $this->property || ! $this->property->exists) {
            $rules['slug'] = 'nullable|string|regex:/^[a-z0-9\-]*$/|unique:properties,slug';
        }

        return $rules;
    }

    protected $messages = [
        'name.required' => 'Property name is required.',
        'name.max' => 'Property name cannot exceed 255 characters.',
        'slug.regex' => 'Slug can only contain lowercase letters, numbers, and hyphens.',
        'slug.unique' => 'This slug is already taken.',
        'address.required' => 'Property address is required.',
        'address.max' => 'Address cannot exceed 500 characters.',
        'welcome_title.required' => 'Welcome title is required.',
        'welcome_title.max' => 'Welcome title cannot exceed 255 characters.',
        'property_directions.url' => 'Please enter a valid URL for directions.',
        'welcome_message.required' => 'Welcome message is required.',
        'welcome_message.max' => 'Welcome message cannot exceed 2000 characters.',
    ];

    public function mount($property = null)
    {
        $this->property = $property;

        if ($this->property && $this->property->exists) {
            $this->name = $this->property->name ?? '';
            $this->slug = $this->property->slug ?? '';
            $this->address = $this->property->address ?? '';
            $this->welcome_title = $this->property->welcome_title ?? '';
            $this->property_directions = $this->property->property_directions ?? '';
            $this->welcome_message = $this->property->welcome_message ?? '';
        } else {
            $this->name = '';
            $this->slug = '';
            $this->address = '';
            $this->welcome_title = '';
            $this->property_directions = '';
            $this->welcome_message = '';
        }
    }

    public function save()
    {
        $validatedData = $this->validate();

        try {
            if ($this->property && $this->property->exists) {
                $updateData = [
                    'name' => $this->name,
                    'address' => $this->address,
                    'welcome_title' => $this->welcome_title,
                    'property_directions' => $this->property_directions,
                    'welcome_message' => $this->welcome_message,
                ];

                $this->property->update($updateData);
                $this->property->refresh();

                session()->flash('success', 'Home section updated successfully!');
            } else {
                // Create new property
                $newProperty = auth()->user()->properties()->create([
                    'name' => $this->name,
                    'slug' => $this->slug,
                    'address' => $this->address,
                    'welcome_title' => $this->welcome_title,
                    'property_directions' => $this->property_directions,
                    'welcome_message' => $this->welcome_message,
                ]);

                return Redirect::to('/dashboard');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while saving. Please try again.');
        }
    }

    public function updatedName()
    {
        if ((! $this->property || ! $this->property->exists) && empty($this->slug)) {
            $this->generateSlugFromName();
        }
    }

    public function generateSlugFromName()
    {
        if ($this->name) {
            $this->slug = \Illuminate\Support\Str::slug($this->name);
        }
    }

    public function render()
    {
        return view('livewire.property-sections.home-section');
    }
}
