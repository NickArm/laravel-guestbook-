<?php

namespace App\Livewire\PropertySections;

use App\Models\Appliance;
use App\Models\ApplianceImage;
use App\Models\Property;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AppliancesSection extends Component
{
    use WithFileUploads;

    public Property $property;

    public $appliances = [];

    // Modal state
    public $showModal = false;

    public $editingAppliance = null;

    // Form fields
    public $title = '';

    public $description = '';

    public $video_url = '';

    public $images = [];

    // Loading states
    public $saving = false;

    public $uploading = false;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'video_url' => 'nullable|url',
        'images.*' => 'image|max:2048',
    ];

    public function mount(Property $property)
    {
        $this->property = $property;
        $this->loadAppliances();
    }

    public function loadAppliances()
    {
        $this->appliances = $this->property->appliances()->with('images')->get();
    }

    public function openModal($applianceId = null)
    {
        $this->resetForm();

        if ($applianceId) {
            $this->editingAppliance = Appliance::with('images')->find($applianceId);
            $this->title = $this->editingAppliance->title;
            $this->description = $this->editingAppliance->description;
            $this->video_url = $this->editingAppliance->video_url;
        }

        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->editingAppliance = null;
        $this->title = '';
        $this->description = '';
        $this->video_url = '';
        $this->images = [];
        $this->resetValidation();
    }

    public function saveAppliance()
    {
        $this->validate();
        $this->saving = true;

        try {
            // Create or update appliance
            if ($this->editingAppliance) {
                $appliance = $this->editingAppliance;
                $appliance->update([
                    'title' => $this->title,
                    'description' => $this->description,
                    'video_url' => $this->video_url,
                ]);
            } else {
                $appliance = Appliance::create([
                    'id' => Str::uuid(),
                    'property_id' => $this->property->id,
                    'title' => $this->title,
                    'description' => $this->description,
                    'video_url' => $this->video_url,
                ]);
            }

            // Upload images if any
            if (! empty($this->images)) {
                $this->uploadImages($appliance);
            }

            $this->loadAppliances();
            $this->closeModal();

            session()->flash('success', 'Appliance saved successfully!');

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to save appliance: '.$e->getMessage());
        } finally {
            $this->saving = false;
        }
    }

    public function uploadImages($appliance)
    {
        foreach ($this->images as $image) {
            try {
                // Parse το CLOUDINARY_URL manual
                $cloudinaryUrl = env('CLOUDINARY_URL');

                if (! $cloudinaryUrl) {
                    throw new \Exception('CLOUDINARY_URL not found');
                }

                $parsed = parse_url($cloudinaryUrl);

                $cloudinary = new \Cloudinary\Cloudinary([
                    'cloud' => [
                        'cloud_name' => $parsed['host'],
                        'api_key' => $parsed['user'],
                        'api_secret' => $parsed['pass'],
                    ],
                ]);

                $upload = $cloudinary->uploadApi()->upload(
                    $image->getRealPath(),
                    [
                        'folder' => "properties/{$this->property->slug}/appliances",
                        'public_id' => Str::uuid(),
                        'overwrite' => false,
                    ]
                );

                // Save image to database
                ApplianceImage::create([
                    'appliance_id' => $appliance->id,
                    'url' => $upload['secure_url'],
                    'public_id' => $upload['public_id'],
                ]);

            } catch (\Exception $e) {
                logger('Failed to upload appliance image: '.$e->getMessage());
                // Continue with other images even if one fails
            }
        }
    }

    public function deleteAppliance($applianceId)
    {
        try {
            $appliance = Appliance::with('images')->find($applianceId);

            // Delete images from Cloudinary and database
            foreach ($appliance->images as $image) {
                try {
                    // Delete from Cloudinary if needed
                    // $cloudinary->uploadApi()->destroy($image->public_id);
                } catch (\Exception $e) {
                    logger('Failed to delete image from Cloudinary: '.$e->getMessage());
                }

                $image->delete();
            }

            $appliance->delete();
            $this->loadAppliances();

            session()->flash('success', 'Appliance deleted successfully!');

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete appliance: '.$e->getMessage());
        }
    }

    public function deleteImage($imageId)
    {
        try {
            $image = ApplianceImage::find($imageId);

            // Delete from Cloudinary if needed
            // $cloudinary->uploadApi()->destroy($image->public_id);

            $image->delete();

            if ($this->editingAppliance) {
                $this->editingAppliance = $this->editingAppliance->fresh('images');
            }

            session()->flash('success', 'Image deleted successfully!');

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete image: '.$e->getMessage());
        }
    }

    public function extractYouTubeId($url)
    {
        if (empty($url)) {
            return null;
        }

        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $matches);

        return $matches[1] ?? null;
    }

    public function render()
    {
        return view('livewire.property-sections.appliances-section');
    }
}
