<?php

namespace App\Livewire\PropertySections;

use App\Models\Review;
use Livewire\Component;

class ReviewSection extends Component
{
    public $property;

    public $review;

    public $enabled = false;

    public $description = '';

    public $url = '';

    protected $rules = [
        'description' => 'required|string|max:500',
        'url' => 'required|url|max:500',
    ];

    protected $messages = [
        'description.required' => 'Review description is required.',
        'description.max' => 'Description cannot exceed 500 characters.',
        'url.required' => 'Review URL is required.',
        'url.url' => 'Please enter a valid URL.',
        'url.max' => 'URL cannot exceed 500 characters.',
    ];

    public function mount($property)
    {
        $this->property = $property;
        $this->enabled = in_array('review', $this->property->enabled_pages ?? []);
        $this->loadReview();
    }

    public function toggleEnabled()
    {
        if (! $this->property) {
            return;
        }

        $enabledPages = $this->property->enabled_pages ?? [];

        if ($this->enabled) {
            // Προσθήκη
            if (! in_array('review', $enabledPages)) {
                $enabledPages[] = 'review';
            }
        } else {
            // Αφαίρεση
            $enabledPages = array_filter($enabledPages, fn ($page) => $page !== 'review');
        }

        $this->property->enabled_pages = array_values($enabledPages);
        $this->property->save();
    }

    public function loadReview()
    {
        if ($this->property) {
            $this->review = Review::where('property_id', $this->property->id)->first();

            if ($this->review) {
                $this->description = $this->review->description;
                $this->url = $this->review->url;
            }
        }
    }

    public function save()
    {
        $this->validate();

        if (! $this->property) {
            session()->flash('error', 'Property not found.');

            return;
        }

        try {
            if ($this->review) {
                // Update existing review
                $this->review->update([
                    'description' => $this->description,
                    'url' => $this->url,
                ]);

                session()->flash('success', 'Review link updated successfully!');
            } else {
                // Create new review
                $this->review = Review::create([
                    'property_id' => $this->property->id,
                    'description' => $this->description,
                    'url' => $this->url,
                ]);

                session()->flash('success', 'Review link saved successfully!');
            }

        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while saving the review link.');
        }
    }

    public function clear()
    {
        if ($this->review) {
            try {
                $this->review->delete();
                $this->review = null;
                $this->description = '';
                $this->url = '';
                session()->flash('success', 'Review link removed successfully!');
            } catch (\Exception $e) {
                session()->flash('error', 'An error occurred while removing the review link.');
            }
        }
    }

    public function render()
    {
        return view('livewire.property-sections.review-section');
    }
}
