<?php

namespace App\Livewire\PropertySections;

use App\Actions\UploadGalleryImagesAction;
use App\Models\Property;
use App\Models\PropertyImage;
use Cloudinary\Cloudinary;
use Livewire\Component;
use Livewire\WithFileUploads;

class GallerySection extends Component
{
    use WithFileUploads;

    public Property $property;

    public $images = [];

    public $enabled = false;

    public $existing_images;

    protected $rules = [
        'images.*' => 'image|max:2048', // 2MB max per image
    ];

    public function mount(Property $property)
    {
        $this->property = $property;
        $this->enabled = $property->gallery_enabled ?? false;
        $this->loadExistingImages();
    }

    public function loadExistingImages()
    {
        $this->existing_images = $this->property->images()->orderBy('created_at', 'desc')->get();
    }

    public function saveEnabledState()
    {
        $this->property->update(['gallery_enabled' => $this->enabled]);

        if ($this->enabled) {
            session()->flash('success', 'Gallery section enabled successfully!');
        } else {
            session()->flash('info', 'Gallery section disabled.');
        }
    }

    public function uploadImages()
    {
        $this->validate();

        if (empty($this->images)) {
            session()->flash('error', 'Please select at least one image.');

            return;
        }

        try {
            $uploadAction = new UploadGalleryImagesAction(app(Cloudinary::class));
            $uploadAction->execute($this->property, $this->images);

            $this->images = [];
            $this->loadExistingImages();

            session()->flash('success', 'Images uploaded successfully!');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function deleteImage($imageId)
    {
        try {
            $image = PropertyImage::findOrFail($imageId);

            // Delete from Cloudinary
            $cloudinary = app(Cloudinary::class);
            $cloudinary->uploadApi()->destroy($image->public_id);

            // Delete from database
            $image->delete();

            $this->loadExistingImages();
            session()->flash('success', 'Image deleted successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting image: '.$e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.property-sections.gallery-section');
    }
}
