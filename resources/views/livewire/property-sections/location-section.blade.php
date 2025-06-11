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

        <!-- Preview when enabled -->
        @if($enabled && ($location_area || $location_country || $google_map_url || $location_description))
            <div class="border rounded p-4 bg-gray-50">
                <h4 class="text-lg font-semibold mb-4 flex items-center gap-2">
                    <i class="ki-outline ki-map text-primary"></i>
                    Location Information Preview
                </h4>
                <div class="grid gap-3">
                    @if($location_area || $location_country)
                        <div class="flex items-center gap-2">
                            <i class="ki-outline ki-geolocation text-gray-500"></i>
                            <span class="font-medium">
                                @if($location_area){{ $location_area }}@endif
                                @if($location_area && $location_country), @endif
                                @if($location_country){{ $location_country }}@endif
                            </span>
                        </div>
                    @endif

                    @if($google_map_url)
                        <div class="flex items-center gap-2">
                            <i class="ki-outline ki-compass text-gray-500"></i>
                            <a href="{{ $google_map_url }}"
                               target="_blank"
                               class="text-blue-600 hover:text-blue-800 underline">
                                View on Google Maps
                            </a>
                            <i class="ki-outline ki-external-link text-gray-400"></i>
                        </div>
                    @endif

                    @if($location_description)
                        <div class="border-t pt-3 mt-3">
                            <p class="text-gray-600">{{ $location_description }}</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Google Maps Embed Preview -->
        @if($enabled && $google_map_url)
            <div class="border rounded p-4 bg-gray-50">
                <h4 class="text-lg font-semibold mb-4 flex items-center gap-2">
                    <i class="ki-outline ki-map text-primary"></i>
                    Map Preview
                </h4>
                <div class="relative">
                    @php
                        // Convert Google Maps share URL to embed URL
                        $embedUrl = '';
                        if (strpos($google_map_url, 'maps.app.goo.gl') !== false || strpos($google_map_url, 'goo.gl/maps') !== false) {
                            // For shortened URLs, we can't easily convert to embed
                            $embedUrl = '';
                        } elseif (strpos($google_map_url, 'google.com/maps') !== false) {
                            // Try to extract coordinates or place ID for embedding
                            if (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $google_map_url, $matches)) {
                                $lat = $matches[1];
                                $lng = $matches[2];
                                $embedUrl = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3000!2d{$lng}!3d{$lat}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM!5e0!3m2!1sen!2s!4v1234567890123!5m2!1sen!2s";
                            }
                        }
                    @endphp

                    @if($embedUrl)
                        <iframe src="{{ $embedUrl }}"
                                width="100%"
                                height="300"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    @else
                        <div class="bg-gray-100 border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                            <i class="ki-outline ki-map text-gray-400 text-3xl mb-2"></i>
                            <p class="text-gray-500 mb-4">Map preview not available for this URL format</p>
                            <a href="{{ $google_map_url }}"
                               target="_blank"
                               class="btn btn-sm btn-primary">
                                <i class="ki-outline ki-external-link"></i>
                                Open in Google Maps
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
