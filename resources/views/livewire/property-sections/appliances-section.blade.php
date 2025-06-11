<!-- resources/views/livewire/property-sections/appliances-section.blade.php -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Property Appliances</h3>
        <div class="flex items-center gap-3">
            <button wire:click="openModal"
                    class="btn btn-sm btn-primary flex items-center gap-2">
                <i class="ki-duotone ki-plus fs-5"></i>
                Add Appliance
            </button>
        </div>
    </div>

    <div class="card-body">

        <!-- Flash Messages -->
        @if (session()->has('success'))
            <div class="alert alert-success mb-4">
                <i class="ki-outline ki-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger mb-4">
                <i class="ki-outline ki-cross-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Appliances List -->
        @if($appliances->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 min-w-0 overflow-hidden">
                @foreach($appliances as $appliance)
                    <div class="border rounded-lg p-8 bg-gray-50">

                        <div class="flex justify-between items-start mb-4">
                            <h4 class="text-l text-gray-800">{{ $appliance->title }}</h4>
                            <div class="flex gap-2">
                                <button wire:click="openModal('{{ $appliance->id }}')"
                                        class="btn btn-sm btn-light">
                                    <i class="ki-outline ki-pencil"></i>
                                    Edit
                                </button>
                                <button wire:click="deleteAppliance('{{ $appliance->id }}')"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this appliance?')">
                                    <i class="ki-outline ki-trash"></i>
                                    Delete
                                </button>
                            </div>
                        </div>

                        <div class="prose max-w-none mb-4 text-sm text-gray-700 leading-relaxed">
                            {!! $appliance->description !!}
                        </div>


                        <!-- Video -->
                        @if($appliance->video_url)
                            @php
                                $videoId = $this->extractYouTubeId($appliance->video_url);
                            @endphp
                            @if($videoId)
                                <div class="mb-4">
                                    <div class="aspect-video bg-gray-200 rounded-lg overflow-hidden">
                                        <iframe
                                            src="https://www.youtube.com/embed/{{ $videoId }}"
                                            class="w-full h-full block"
                                            style="max-width: 100%;"
                                            frameborder="0"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                </div>
                            @endif
                        @endif

                        <!-- Images -->
                        @if($appliance->images->count() > 0)
                            <div>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                    @foreach($appliance->images as $image)
                                        <div class="aspect-square bg-gray-200 rounded-lg overflow-hidden">
                                            <img src="{{ $image->url }}"
                                                 alt="Appliance image"
                                                 class="w-full h-full object-cover">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 text-gray-500">
                <i class="ki-outline ki-devices text-6xl mb-4 text-gray-300"></i>
                <h4 class="text-lg font-medium mb-2">No appliances added yet</h4>
                <p class="mb-4">Add appliances to help guests understand how to use property amenities.</p>
                <button wire:click="openModal" class="btn btn-primary">
                    <i class="ki-outline ki-plus"></i>
                    Add First Appliance
                </button>
            </div>
        @endif

    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
             wire:click.self="closeModal">
            <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto"
                 wire:click.stop>

                <!-- Modal Header -->
                <div class="border-b p-6">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold">
                            {{ $editingAppliance ? 'Edit Appliance' : 'Add New Appliance' }}
                        </h3>
                        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                            <i class="ki-outline ki-cross text-xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-6 space-y-6">

                    <!-- Title -->
                    <div>
                        <label class="form-label">Appliance Title *</label>
                        <input type="text"
                               wire:model.live="title"
                               class="input"
                               placeholder="e.g., Washing Machine, Coffee Maker, Air Conditioner">
                        @error('title')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description with Text Editor -->
                    <div>
                        <label class="form-label">Instructions & Description *</label>
                        <div wire:ignore>
                            <textarea id="appliance-description"
                                      wire:model="description"
                                      class="input min-h-[200px]"
                                      placeholder="Provide detailed instructions on how to use this appliance..."></textarea>
                        </div>
                        @error('description')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- YouTube Video -->
                    <div>
                        <label class="form-label">YouTube Video URL (Optional)</label>
                        <input type="url"
                               wire:model.live="video_url"
                               class="input"
                               placeholder="https://www.youtube.com/watch?v=...">
                        @error('video_url')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror

                        <!-- Video Preview -->
                        @if($video_url)
                            @php
                                $videoId = $this->extractYouTubeId($video_url);
                            @endphp
                            @if($videoId)
                                <div class="mt-3 p-3 bg-green-50 border border-green-200 rounded">
                                    <p class="text-green-700 text-sm">✓ Valid YouTube URL detected</p>
                                    <div class="mt-2 aspect-video bg-gray-200 rounded overflow-hidden">
                                        <iframe
                                            src="https://www.youtube.com/embed/{{ $videoId }}"
                                            class="w-full h-full"
                                            frameborder="0">
                                        </iframe>
                                    </div>
                                </div>
                            @else
                                <div class="mt-2 text-red-500 text-sm">Invalid YouTube URL format</div>
                            @endif
                        @endif
                    </div>

                    <!-- Images Upload -->
                    <div>
                        <label class="form-label">Images (Optional)</label>
                        <input type="file"
                               wire:model="images"
                               multiple
                               accept="image/*"
                               class="input">
                        @error('images.*')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror

                        <!-- Image Previews -->
                        @if(!empty($images))
                            <div class="mt-3 grid grid-cols-3 gap-3">
                                @foreach($images as $index => $image)
                                    <div class="aspect-square bg-gray-200 rounded-lg overflow-hidden relative">
                                        <img src="{{ $image->temporaryUrl() }}"
                                             class="w-full h-full object-cover">
                                        <button type="button"
                                                wire:click="$set('images.{{ $index }}', null)"
                                                class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">
                                            ×
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Existing Images (when editing) -->
                        @if($editingAppliance && $editingAppliance->images->count() > 0)
                            <div class="mt-3">
                                <p class="text-sm text-gray-600 mb-2">Existing Images:</p>
                                <div class="grid grid-cols-3 gap-3">
                                    @foreach($editingAppliance->images as $image)
                                        <div class="aspect-square bg-gray-200 rounded-lg overflow-hidden relative">
                                            <img src="{{ $image->url }}"
                                                 class="w-full h-full object-cover">
                                            <button type="button"
                                                    wire:click="deleteImage({{ $image->id }})"
                                                    class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                    onclick="return confirm('Delete this image?')">
                                                ×
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="border-t p-6 flex justify-end gap-3">
                    <button wire:click="closeModal" class="btn btn-light">
                        Cancel
                    </button>
                    <button wire:click="saveAppliance"
                            class="btn btn-primary"
                            wire:loading.attr="disabled"
                            wire:target="saveAppliance">
                        <span wire:loading.remove wire:target="saveAppliance">
                            <i class="ki-outline ki-check"></i>
                            {{ $editingAppliance ? 'Update' : 'Save' }} Appliance
                        </span>
                        <span wire:loading wire:target="saveAppliance">
                            <i class="ki-outline ki-arrows-circle animate-spin"></i>
                            Saving...
                        </span>
                    </button>
                </div>

            </div>
        </div>
    @endif

</div>

<!-- Simple Text Editor Script -->
@push('scripts')
<script>
    document.addEventListener('livewire:init', () => {
        // Initialize text editor when modal opens
        Livewire.on('modalOpened', () => {
            setTimeout(() => {
                const textarea = document.getElementById('appliance-description');
                if (textarea) {
                    // You can integrate a rich text editor here like TinyMCE or Quill
                    // For now, we'll use a simple textarea
                }
            }, 100);
        });
    });
</script>
@endpush
