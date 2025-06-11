<!-- resources/views/livewire/property-sections/before-you-go-section.blade.php -->
<div class="card pb-2.5">
    <div class="card-header flex justify-between items-center">
        <h3 class="card-title">Before You Go</h3>
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
            <label class="form-label max-w-56">Before You Go Content</label>
            <div class="grow">
                <div wire:ignore>
                    <textarea
                        id="before_you_go_editor"
                        class="ckeditor"
                        data-livewire-component="{{ $this->getId() }}"
                    >{!! $content !!}</textarea>
                </div>
                @error('content')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>
