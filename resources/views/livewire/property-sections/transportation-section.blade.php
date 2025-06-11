<!-- resources/views/livewire/property-sections/transportation-section.blade.php -->
<div class="card pb-2.5">
    <div class="card-header flex justify-between items-center">
        <h3 class="card-title">Transportation</h3>
        <div class="flex items-center gap-4">
            <label class="switch">
                <input type="checkbox" wire:model="enabled">
                <span class="switch-label">Enabled</span>
            </label>
            <button wire:click="openModal" class="btn btn-sm btn-primary">
                <i class="ki-outline ki-plus"></i>
                Add Transportation
            </button>
        </div>
    </div>

    <!-- WORKING MODAL -->
    @if($showModal)
        <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 99999; display: flex; align-items: center; justify-content: center; padding: 20px; box-sizing: border-box;">
            <div style="background: white; border-radius: 8px; width: 100%; max-width: 500px; max-height: 90vh; overflow-y: auto; box-shadow: 0 4px 20px rgba(0,0,0,0.3);">
                <!-- Header -->
                <div style="padding: 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
                    <h3 style="margin: 0; color: #333; font-size: 18px;">{{ $editingId ? 'Edit Transportation' : 'Add Transportation' }}</h3>
                    <button wire:click="closeModal" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #999; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; border-radius: 50%; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f0f0f0'" onmouseout="this.style.backgroundColor='transparent'">&times;</button>
                </div>

                <!-- Body -->
                <div style="padding: 20px;">
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #555;">Transportation Type/Title</label>
                        <input wire:model="title"
                               type="text"
                               placeholder="e.g., Taxi, Bus, Airport Transfer"
                               style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; box-sizing: border-box; transition: border-color 0.2s; outline: none;"
                               onfocus="this.style.borderColor='#007bff'"
                               onblur="this.style.borderColor='#ddd'">
                        @error('title')
                            <div style="color: #dc3545; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #555;">Description & Instructions</label>
                        <textarea wire:model="description"
                                  rows="5"
                                  placeholder="Provide detailed instructions, contact numbers, costs, etc."
                                  style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; resize: vertical; font-size: 14px; font-family: inherit; box-sizing: border-box; transition: border-color 0.2s; outline: none;"
                                  onfocus="this.style.borderColor='#007bff'"
                                  onblur="this.style.borderColor='#ddd'"></textarea>
                        @error('description')
                            <div style="color: #dc3545; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                        @enderror
                        <div style="color: #6c757d; font-size: 12px; margin-top: 5px;">
                            💡 Include phone numbers, costs, booking instructions, or any other helpful details.
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div style="padding: 20px; border-top: 1px solid #eee; display: flex; justify-content: flex-end; gap: 12px;">
                    <button wire:click="closeModal"
                            style="padding: 10px 20px; border: 1px solid #ddd; background: #f8f9fa; border-radius: 6px; cursor: pointer; font-size: 14px; transition: all 0.2s;"
                            onmouseover="this.style.backgroundColor='#e9ecef'"
                            onmouseout="this.style.backgroundColor='#f8f9fa'">
                        Cancel
                    </button>
                    <button wire:click="save"
                            style="padding: 10px 20px; border: none; background: #007bff; color: white; border-radius: 6px; cursor: pointer; font-size: 14px; transition: background-color 0.2s;"
                            wire:loading.attr="disabled"
                            onmouseover="this.style.backgroundColor='#0056b3'"
                            onmouseout="this.style.backgroundColor='#007bff'">
                        <span wire:loading.remove>{{ $editingId ? 'Update' : 'Add' }}</span>
                        <span wire:loading>Saving...</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="card-body">
        @if($property->transportation && $property->transportation->count() > 0)
            <div class="grid gap-4">
                @foreach($property->transportation as $transport)
                    <div class="border rounded p-4 relative hover:bg-gray-50">
                        <div class="flex justify-between items-start">
                            <div class="grow">
                                <div class="flex items-center gap-3 mb-2">
                                    <i class="ki-outline ki-bus text-primary text-xl"></i>
                                    <h4 class="font-semibold text-lg">{{ $transport->title }}</h4>
                                </div>

                                <div class="text-gray-600 leading-relaxed">
                                    {{ $transport->description }}
                                </div>
                            </div>

                            <div class="flex gap-2 ml-4 flex-shrink-0">
                                <button wire:click="editTransportation({{ $transport->id }})"
                                        class="btn btn-xs btn-secondary">
                                    <i class="ki-outline ki-pencil"></i>
                                    Edit
                                </button>
                                <button wire:click="deleteTransportation({{ $transport->id }})"
                                        class="btn btn-xs btn-danger"
                                        onclick="confirm('Are you sure you want to delete this transportation option?') || event.stopImmediatePropagation()">
                                    <i class="ki-outline ki-trash"></i>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8 text-gray-500">
                <i class="ki-outline ki-bus text-3xl mb-2"></i>
                <p class="text-lg mb-2">No transportation options added yet.</p>
                <p class="text-sm mb-4">Add transportation information to help guests reach your property.</p>
                <button wire:click="openModal" class="btn btn-sm btn-primary">
                    <i class="ki-outline ki-plus"></i>
                    Add First Transportation Option
                </button>
            </div>
        @endif
    </div>
</div>

<!-- Transportation Modal -->
@if($showModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" wire:ignore.self>
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black bg-opacity-50" wire:click="closeModal"></div>

        <!-- Modal Content -->
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative bg-white rounded-lg shadow-xl max-w-lg w-full">
                <!-- Modal Header -->
                <div class="flex justify-between items-center p-6 border-b">
                    <h3 class="text-lg font-semibold">
                        {{ $editingId ? 'Edit Transportation' : 'Add Transportation' }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                        <i class="ki-outline ki-cross text-xl"></i>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-6 space-y-4">
                    <div>
                        <label class="form-label">Transportation Type/Title</label>
                        <input wire:model="title"
                               class="input w-full @error('title') border-red-500 @enderror"
                               type="text"
                               placeholder="e.g., Taxi, Bus, Airport Transfer">
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label">Description & Instructions</label>
                        <textarea wire:model="description"
                                  class="input w-full @error('description') border-red-500 @enderror"
                                  rows="5"
                                  placeholder="Provide detailed instructions, contact numbers, costs, etc."></textarea>
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        <div class="text-sm text-gray-500 mt-1">
                            Include phone numbers, costs, booking instructions, or any other helpful details.
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end gap-2 p-6 border-t">
                    <button wire:click="closeModal" class="btn btn-light">Cancel</button>
                    <button wire:click="save" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>{{ $editingId ? 'Update' : 'Add' }}</span>
                        <span wire:loading>Saving...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Transportation Examples for better UX -->
@if($showModal && !$editingId)
    <div class="fixed bottom-4 right-4 max-w-sm bg-blue-50 border border-blue-200 rounded-lg p-4 shadow-lg">
        <h5 class="font-semibold text-blue-800 mb-2">💡 Transportation Examples:</h5>
        <ul class="text-sm text-blue-700 space-y-1">
            <li>• <strong>Taxi:</strong> Call 12345 or book online</li>
            <li>• <strong>Bus:</strong> Line 16 from airport, €2.50</li>
            <li>• <strong>Car Rental:</strong> Hertz counter at airport</li>
            <li>• <strong>Airport Transfer:</strong> Book with us for €25</li>
        </ul>
        <button onclick="this.parentElement.style.display='none'"
                class="absolute top-2 right-2 text-blue-400 hover:text-blue-600">✕</button>
    </div>
@endif
