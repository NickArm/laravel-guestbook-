<!-- resources/views/livewire/property-sections/review-section.blade.php -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Review Link</h3>
        <div class="flex items-center gap-3">
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
        <!-- Flash Messages -->
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
            <!-- Description -->
            <div>
                <label class="form-label required text-sm font-medium">Review Link Description</label>
                <input type="text"
                       wire:model="description"
                       class="form-control"
                       placeholder="e.g., Leave us a review on Airbnb">
                @error('description')
                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                @enderror
                <div class="text-xs text-gray-500 mt-1">
                    This text will be displayed to guests as a call-to-action
                </div>
            </div>

            <!-- URL -->
            <div>
                <label class="form-label required text-sm font-medium">Review URL</label>
                <input type="url"
                       wire:model="url"
                       class="form-control"
                       placeholder="https://www.airbnb.com/rooms/12345/reviews">
                @error('url')
                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                @enderror
                <div class="text-xs text-gray-500 mt-1">
                    Direct link where guests can leave a review (Airbnb, Booking.com, etc.)
                </div>
            </div>


        </div>
    </div>
</div>
