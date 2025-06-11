<!-- resources/views/livewire/property-sections/recommendations-section.blade.php -->
<div class="card pb-2.5">
    <div class="card-header flex justify-between items-center">
        <h3 class="card-title">Recommendations</h3>
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

    <div class="card-body">
        @if($availableRecommendations && $availableRecommendations->count() > 0)
            @foreach($availableRecommendations as $sectionName => $recommendations)
                <div class="mb-8 last:mb-0">
                    <h4 class="text-l mb-3 text-gray-800 border-b pb-2 flex items-center gap-2">
                        @if($sectionName === 'My Recommendations')
                            <i class="ki-outline ki-user text-primary"></i>
                            <span class="text-primary">{{ $sectionName }}</span>
                        @else
                            <i class="ki-outline ki-people text-gray-600"></i>
                            <span class="text-gray-600">{{ $sectionName }}</span>
                        @endif
                        <span class="text-sm text-gray-500 font-normal">
                            ({{ $recommendations->count() }} available)
                        </span>
                    </h4>

                    <div class="grid gap-3">
                        @foreach($recommendations as $recommendation)
                            <div class="border rounded-lg p-4 transition-all duration-200 {{ in_array($recommendation->id, $selectedRecommendations) ? 'border-primary bg-primary/5 shadow-sm' : 'border-gray-200 hover:border-gray-300' }}">
                                <div class="flex items-start gap-4">
                                    <!-- Checkbox -->
                                    <label class="flex items-start gap-3 cursor-pointer grow">
                                        <input type="checkbox"
                                               wire:change="toggleRecommendation('{{ $recommendation->id }}')"
                                               {{ in_array($recommendation->id, $selectedRecommendations) ? 'checked' : '' }}
                                               class="checkbox mt-1">

                                        <div class="grow">
                                            <div class="flex items-center gap-2 mb-1">
                                                <h5 class="text-l text-gray-900">
                                                    {{ $recommendation->title }}
                                                </h5>
                                                @if($sectionName === 'Other Hosts Recommendations')
                                                    <span class="badge badge-secondary text-xs">
                                                        by {{ $recommendation->user->name ?? 'Other Host' }}
                                                    </span>
                                                @endif
                                            </div>

                                            @if($recommendation->description)
                                                <div class="text-gray-600 mb-3 font-sm">
                                                    {{ $recommendation->description }}
                                                </div>
                                            @endif

                                            <!-- Details Grid -->
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm">
                                                @if($recommendation->website_url)
                                                    <div class="flex items-center gap-2">
                                                        <i class="ki-outline ki-external-link text-gray-500"></i>
                                                        <a href="{{ $recommendation->website_url }}"
                                                           target="_blank"
                                                           class="text-primary hover:underline">
                                                            Visit Website
                                                        </a>
                                                    </div>
                                                @endif

                                                @if($recommendation->directions_url)
                                                    <div class="flex items-center gap-2">
                                                        <i class="ki-outline ki-map text-gray-500"></i>
                                                        <a href="{{ $recommendation->directions_url }}"
                                                           target="_blank"
                                                           class="text-primary hover:underline">
                                                            Get Directions
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </label>

                                    <!-- Image (if available) -->
                                    @if($recommendation->image_url)
                                        <div class="flex-shrink-0">
                                            <img src="{{ $recommendation->image_url }}"
                                                 alt="{{ $recommendation->title }}"
                                                 class="w-20 h-20 object-cover rounded-lg">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <!-- Summary -->
            @if(count($selectedRecommendations) > 0)
                <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="flex items-center gap-2 text-blue-800">
                        <i class="ki-outline ki-check-circle"></i>
                        <span class="font-medium">
                            {{ count($selectedRecommendations) }} recommendation(s) selected for this property
                        </span>
                    </div>
                </div>
            @endif
        @else
            <div class="text-center py-12 text-gray-500">
                <i class="ki-outline ki-bookmark text-4xl mb-4 text-gray-400"></i>
                <h4 class="text-lg font-medium mb-2">No Recommendations Available</h4>
                <p class="text-gray-400 mb-4">
                    Create recommendations in the main recommendations section first, then come back here to assign them to this property.
                </p>
                <a href="{{ route('recommendations.index') }}" class="btn btn-sm btn-primary">
                    <i class="ki-outline ki-plus"></i>
                    Manage Recommendations
                </a>
            </div>
        @endif
    </div>
</div>
