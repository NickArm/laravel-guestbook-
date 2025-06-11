<?php

namespace App\Livewire\PropertySections;

use App\Models\Property;
use App\Models\Recommendation;
use App\Traits\EnabledPages;
use Livewire\Component;

class RecommendationsSection extends Component
{
    use EnabledPages;

    public Property $property;

    public $enabled = false;

    public $selectedRecommendations = [];

    public $availableRecommendations;

    public function mount(Property $property)
    {
        $this->property = $property;
        $this->enabled = $this->isSectionEnabled('recommendations');

        // Φόρτωσε όλα τα διαθέσιμα recommendations grouped by category
        $this->loadAvailableRecommendations();

        // Φόρτωσε τα ήδη επιλεγμένα recommendations για αυτό το property
        $this->selectedRecommendations = $this->property
            ->recommendations()
            ->pluck('id')
            ->toArray();
    }

    public function loadAvailableRecommendations()
    {
        $userId = auth()->id();

        $myRecommendations = Recommendation::where('user_id', $userId)->get();
        $otherRecommendations = Recommendation::where('user_id', '!=', $userId)->get();

        $this->availableRecommendations = collect([
            'My Recommendations' => $myRecommendations,
            'Other Hosts Recommendations' => $otherRecommendations,
        ]);
    }

    public function updatedEnabled()
    {
        $this->updateEnabledState('recommendations', $this->enabled);
    }

    public function toggleRecommendation($recommendationId)
    {
        if (in_array($recommendationId, $this->selectedRecommendations)) {
            // Remove from selection
            $this->selectedRecommendations = array_values(
                array_filter($this->selectedRecommendations, function ($id) use ($recommendationId) {
                    return $id !== $recommendationId;
                })
            );
        } else {
            // Add to selection
            $this->selectedRecommendations[] = $recommendationId;
        }
    }

    public function save()
    {
        // Sync the many-to-many relationship
        // Note: We allow both own and other hosts' recommendations to be selected
        $this->property->recommendations()->sync($this->selectedRecommendations);

        session()->flash('message', 'Recommendations updated successfully!');
    }

    public function render()
    {
        return view('livewire.property-sections.recommendations-section');
    }
}
