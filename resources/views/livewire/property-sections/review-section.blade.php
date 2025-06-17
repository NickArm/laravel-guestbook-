<div class="card">
    <div class="card-header flex justify-between items-center">
        <h3 class="card-title">Review Link</h3>

        <div class="flex items-center gap-4">
            <label class="switch">
                <input type="checkbox" wire:model="enabled" wire:click="toggleEnabled">
                <span class="switch-label">Enabled</span>
            </label>

            <button wire:click="save"
                    class="btn btn-sm btn-primary"
                    wire:loading.attr="disabled"
                    wire:target="save">
                <span wire:loading.remove wire:target="save">
                    <i class="ki-duotone ki-check fs-5 me-1"></i>
                    Save
                </span>
                <span wire:loading wire:target="save">
                    <i class="ki-duotone ki-arrows-circle animate-spin fs-5 me-1"></i>
                    Saving...
                </span>
            </button>
        </div>
    </div>

    <div class="card-body p-0">
        @if (session()->has('success'))
            <div class="alert alert-success mx-6 mt-6">
                <i class="ki-duotone ki-check-circle fs-4 me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger mx-6 mt-6">
                <i class="ki-duotone ki-cross-circle fs-4 me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="p-8 space-y-6">
            <!-- Description Field -->
            <div class="mb-8">
                <label class="form-label required text-sm font-medium mb-1 block">Review Link Description</label>
                <div class="relative">
                    <input type="text"
                           wire:model="description"
                           class="form-control bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-primary focus:border-primary w-full p-3"
                           placeholder="e.g., Leave us a review on Airbnb">
                </div>
                @error('description')
                    <p class="text-danger text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-500 mt-1">
                    This text will be displayed to guests as a call-to-action
                </p>
            </div>

            <!-- URL Field -->
            <div>
                <label class="form-label required text-sm font-medium mb-1 block">Review URL</label>
                <div class="relative">
                    <input type="url"
                           wire:model="url"
                           class="form-control bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-primary focus:border-primary w-full p-3"
                           placeholder="https://www.airbnb.com/rooms/12345/reviews">
                </div>
                @error('url')
                    <p class="text-danger text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-500 mt-1">
                    Direct link where guests can leave a review (Airbnb, Booking.com, etc.)
                </p>
            </div>
        </div>
    </div>
</div>
