<!-- resources/views/livewire/property-sections/amenities-section.blade.php -->
<div class="card pb-2.5">
    <div class="card-header flex justify-between items-center">
        <h3 class="card-title">Amenities</h3>
        <div class="flex items-center gap-3">
            <label class="switch">
                <input type="checkbox" wire:model.live="enabled">
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
            <label class="form-label max-w-56">Amenities Description</label>
            <div class="grow">
                <div wire:ignore>
                    <textarea id="amenities_editor" class="ckeditor">{!! $description !!}</textarea>
                </div>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>
