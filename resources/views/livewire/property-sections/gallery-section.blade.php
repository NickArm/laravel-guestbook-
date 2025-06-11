<!-- resources/views/livewire/property-sections/gallery-section.blade.php -->
<div class="card pb-2.5">
    <div class="card-header flex justify-between items-center">
        <h3 class="card-title">Gallery</h3>
        <div class="flex items-center gap-4">
            <label class="switch">
                <input type="checkbox" wire:model="enabled" wire:change="saveEnabledState">
                <span class="switch-label">Enabled</span>
            </label>
        </div>
    </div>

    <div class="card-body">
        <!-- Upload Section -->
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 mb-6">
            <div class="text-center">
                <i class="ki-outline ki-cloud-add text-3xl text-gray-400 mb-3"></i>
                <h4 class="text-lg font-medium mb-2">Upload Images</h4>
                <p class="text-gray-600 mb-4">Select multiple images to upload to your gallery</p>

                <input type="file" wire:model="images" multiple accept="image/*" class="hidden" id="image-upload">
                <label for="image-upload" class="btn btn-primary cursor-pointer">
                    <i class="ki-outline ki-plus"></i>
                    Choose Images
                </label>

                @if($images)
                    <div class="mt-4">
                        <p class="text-sm text-gray-600 mb-2">{{ count($images) }} image(s) selected</p>
                        <button wire:click="uploadImages" class="btn btn-success" wire:loading.attr="disabled">
                            <span wire:loading.remove>Upload Images</span>
                            <span wire:loading>Uploading...</span>
                        </button>
                    </div>
                @endif

                @error('images.*')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Existing Images Grid -->
        @if($existing_images && $existing_images->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($existing_images as $image)
                    <div class="relative group border rounded-lg overflow-hidden">
                        <img src="{{ $image->url }}" alt="{{ $image->alt_text }}" class="w-full h-32 object-cover">

                        <!-- Overlay with actions -->
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <div class="flex gap-2">
                                <button wire:click="deleteImage({{ $image->id }})"
                                        class="btn btn-xs btn-danger"
                                        onclick="confirm('Are you sure?') || event.stopImmediatePropagation()">
                                    <i class="ki-outline ki-trash"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Alt text input -->
                        <div class="p-2">
                            <input type="text"
                                   value="{{ $image->alt_text }}"
                                   wire:change="updateAltText({{ $image->id }}, $event.target.value)"
                                   placeholder="Alt text..."
                                   class="input input-sm w-full text-xs">
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8 text-gray-500">
                <i class="ki-outline ki-picture text-3xl mb-2"></i>
                <p>No images uploaded yet.</p>
                <p class="text-sm">Upload your first images using the section above.</p>
            </div>
        @endif
    </div>
</div>
