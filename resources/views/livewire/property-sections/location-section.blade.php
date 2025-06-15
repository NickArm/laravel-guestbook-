<!-- resources/views/livewire/property-sections/location-section.blade.php -->
<div class="card pb-2.5">
    <div class="card-header flex justify-between items-center">
        <h3 class="card-title">Location</h3>
        <div class="flex items-center gap-4">
            <label class="switch">
                <input type="checkbox" wire:model="enabled">
                <span class="switch-label">Enabled</span>
            </label>
            <button wire:click="save" class="btn btn-sm btn-primary" wire:loading.attr="disabled">
                <span wire:loading.remove>Save</span>
                <span wire:loading>Saving...</span>
            </button>
        </div>
    </div>

    <div class="card-body grid gap-5">
        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-56">Area/City</label>
            <div class="grow">
                <input wire:model="location_area"
                       class="input @error('location_area') border-red-500 @enderror"
                       type="text"
                       placeholder="POTAMOS, CORFU">
                @error('location_area')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-56">Country</label>
            <div class="grow">
                <input wire:model="location_country"
                       class="input @error('location_country') border-red-500 @enderror"
                       type="text"
                       placeholder="49100, GREECE">
                @error('location_country')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-56">Google Maps URL</label>
            <div class="grow">
                <input wire:model="google_map_url"
                       class="input @error('google_map_url') border-red-500 @enderror"
                       type="url"
                       placeholder="https://maps.app.goo.gl/aFonFwzAVSyPUVh8A">
                @error('google_map_url')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <span class="text-xs text-gray-500 mt-1">
                    <i class="ki-outline ki-information-2"></i>
                    Get the URL by sharing a location from Google Maps
                </span>
            </div>
        </div>

        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-56">Location Description</label>
            <div class="grow">
                <textarea wire:model="location_description"
                          class="input @error('location_description') border-red-500 @enderror"
                          rows="4"
                          placeholder="A beautiful apartment near Corfu..."></textarea>
                @error('location_description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>
