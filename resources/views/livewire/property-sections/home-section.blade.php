<!-- resources/views/livewire/property-sections/home-section.blade.php -->
<div class="card pb-2.5">
    <div class="card-header flex justify-between items-center">
        <h3 class="card-title">Home</h3>
        <button wire:click="save" class="btn btn-sm btn-primary" wire:loading.attr="disabled">
            <span wire:loading.remove>Save</span>
            <span wire:loading>Saving...</span>
        </button>
    </div>

    <div class="card-body grid gap-5">
        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-56">Name</label>
            <div class="grow">
                <input wire:model="name" class="input" type="text" placeholder="Property name">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-56">Slug</label>
            <div class="grow">
                <input wire:model="slug" class="input" type="text" placeholder="property-slug">
                @error('slug')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-56">Address</label>
            <div class="grow">
                <input wire:model="address" class="input" type="text" placeholder="Property address">
                @error('address')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-56">Welcome Title</label>
            <div class="grow">
                <input wire:model="welcome_title" class="input" type="text" placeholder="Welcome title">
                @error('welcome_title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-56">Google Maps Directions URL</label>
            <div class="grow">
                <input wire:model="property_directions" class="input" type="url" placeholder="https://maps.google.com/...">
                @error('property_directions')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-56">Welcome Message</label>
            <div class="grow">
                <textarea
                    wire:model="welcome_message"
                    rows="4"
                    placeholder="Welcome message for guests"
                    class="w-full min-h-[120px] bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-primary focus:border-primary p-4 pt-5"
                    ></textarea>
                @error('welcome_message')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>
