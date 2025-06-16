<?php

namespace App\Livewire\PropertySections;

use App\Models\Property;
use App\Models\Setting;
use App\Traits\EnabledPages;
use Livewire\Component;
use Livewire\WithFileUploads;

class SettingsSection extends Component
{
    use EnabledPages;
    use WithFileUploads;

    public Property $property;

    // Settings fields
    public $primary_color = '#3b82f6';

    public $secondary_color = '#6b7280';

    // Logo upload
    public $logo;

    public $current_logo_url;

    // Loading states
    public $uploading = false;

    public $saving = false;

    public ?string $blog_url = null;

    public bool $blog_enabled = false;

    public function mount(Property $property)
    {
        $this->property = $property;
        $this->current_logo_url = $property->logo_url;

        // Load existing settings
        $settings = $property->settings()->first();
        if ($settings) {
            $this->primary_color = $settings->primary_color ?? '#3b82f6';
            $this->secondary_color = $settings->secondary_color ?? '#6b7280';
            $this->blog_url = $property->settings->blog_url;
            $this->blog_enabled = $this->isSectionEnabled('blog');
        }
    }

    public function updatedLogo()
    {

        $this->validate([
            'logo' => 'image|max:2048', // 2MB max
        ]);
    }

    public function uploadLogo()
    {
        $this->validate([
            'logo' => 'required|image|max:2048',
        ]);

        $this->uploading = true;
        try {
            app(\App\Actions\UploadLogoAction::class)->execute($this->logo, $this->property);

            // Refresh the current logo URL
            $this->current_logo_url = $this->property->fresh()->logo_url;
            $this->logo = null;

            session()->flash('success', 'Logo uploaded successfully!');

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to upload logo: '.$e->getMessage());
        } finally {
            $this->uploading = false;
        }
    }

    public function removeLogo()
    {
        try {
            if ($this->property->logo_url) {
                $publicId = "properties/{$this->property->slug}/logo";

                app(\Cloudinary\Cloudinary::class)->uploadApi()->destroy($publicId);
            }

            $this->property->update(['logo_url' => null]);
            $this->current_logo_url = null;

            session()->flash('success', 'Logo removed successfully!');
        } catch (\Exception $e) {

            session()->flash('error', 'Failed to remove logo.');
        }
    }

    public function saveSettings()
    {
        $this->validate([
            'primary_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'secondary_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'blog_url' => 'nullable|url',
        ]);

        $this->saving = true;

        try {
            Setting::updateOrCreate(
                ['property_id' => $this->property->id],
                [
                    'primary_color' => $this->primary_color,
                    'secondary_color' => $this->secondary_color,
                    'blog_url' => $this->blog_url,
                ]
            );

            session()->flash('success', 'Settings saved successfully!');

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to save settings: '.$e->getMessage());
        } finally {
            $this->saving = false;
        }
    }

    public function render()
    {
        return view('livewire.property-sections.settings-section');
    }
}
