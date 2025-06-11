<!-- resources/views/livewire/property-sections/rules-section.blade.php -->
<div>
    <div class="card pb-2.5">
        <div class="card-header flex justify-between items-center">
            <h3 class="card-title">Rules</h3>
            <div class="flex items-center gap-4">
                <label class="switch">
                    <input type="checkbox" wire:model="enabled">
                    <span class="switch-label">Enabled</span>
                </label>
                <button wire:click="openModal" class="btn btn-sm btn-primary">
                    <i class="ki-outline ki-plus"></i>
                    Add Rule
                </button>
            </div>
        </div>

        <div class="card-body">
            @if($property->rules && $property->rules->count() > 0)
                <div class="grid gap-4">
                    @foreach($property->rules as $rule)
                        <div class="border rounded p-4 relative hover:bg-gray-50">
                            <div class="flex justify-between items-start">
                                <div class="grow">
                                    <div class="flex items-center gap-3 mb-2">
                                        <i class="ki-outline ki-shield-tick text-primary text-xl"></i>
                                        <h4 class="text-lg">{{ $rule->title }}</h4>
                                    </div>

                                    <div class="text-gray-600 leading-relaxed">
                                        {{ $rule->description }}
                                    </div>
                                </div>

                                <div class="flex gap-2 ml-4 flex-shrink-0">
                                    <button wire:click="editRule({{ $rule->id }})"
                                            class="btn btn-xs btn-secondary">
                                        <i class="ki-outline ki-pencil"></i>
                                        Edit
                                    </button>
                                    <button wire:click="deleteRule({{ $rule->id }})"
                                            class="btn btn-xs btn-danger"
                                            onclick="confirm('Are you sure you want to delete this rule?') || event.stopImmediatePropagation()">
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
                    <i class="ki-outline ki-shield-tick text-3xl mb-2"></i>
                    <p class="text-lg mb-2">No rules added yet.</p>
                    <p class="text-sm mb-4">Add property rules to set clear expectations for your guests.</p>
                    <button wire:click="openModal" class="btn btn-sm btn-primary">
                        <i class="ki-outline ki-plus"></i>
                        Add First Rule
                    </button>
                </div>
            @endif

            <!-- Preview section when enabled -->
            @if($enabled && $property->rules && $property->rules->count() > 0)
                <div class="border-t mt-6 pt-6">
                    <h4 class="text-l mb-4 flex items-center gap-2">
                        <i class="ki-outline ki-eye text-primary"></i>
                        Guest View Preview
                    </h4>
                    <div class="bg-gray-50 rounded p-4 space-y-4">
                        @foreach($property->rules as $rule)
                            <div class="bg-white rounded border p-4">
                                <h5 class="font-semibold text-red-600 mb-2 flex items-center gap-2">
                                    <i class="ki-outline ki-shield-tick text-red-600"></i>
                                    {{ $rule->title }}
                                </h5>
                                <p class="text-gray-700">{{ $rule->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal inside the same root element -->
    @if($showModal)
        <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 99999; display: flex; align-items: center; justify-content: center; padding: 20px; box-sizing: border-box;">
            <div style="background: white; border-radius: 8px; width: 100%; max-width: 500px; max-height: 90vh; overflow-y: auto; box-shadow: 0 4px 20px rgba(0,0,0,0.3);">
                <div style="padding: 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
                    <h3 style="margin: 0; color: #333; font-size: 18px;">{{ $editingId ? 'Edit Rule' : 'Add Rule' }}</h3>
                    <button wire:click="closeModal" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #999; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; border-radius: 50%; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f0f0f0'" onmouseout="this.style.backgroundColor='transparent'">&times;</button>
                </div>

                <div style="padding: 20px;">
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #555;">Rule Title</label>
                        <input wire:model="title"
                               type="text"
                               placeholder="e.g., NO SMOKING, NO PETS, Quiet Hours"
                               style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; box-sizing: border-box; transition: border-color 0.2s; outline: none;"
                               onfocus="this.style.borderColor='#007bff'"
                               onblur="this.style.borderColor='#ddd'">
                        @error('title')
                            <div style="color: #dc3545; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #555;">Rule Description</label>
                        <textarea wire:model="description"
                                  rows="5"
                                  placeholder="Provide detailed explanation of the rule and any consequences..."
                                  style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; resize: vertical; font-size: 14px; font-family: inherit; box-sizing: border-box; transition: border-color 0.2s; outline: none;"
                                  onfocus="this.style.borderColor='#007bff'"
                                  onblur="this.style.borderColor='#ddd'"></textarea>
                        @error('description')
                            <div style="color: #dc3545; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                        @enderror
                        <div style="color: #6c757d; font-size: 12px; margin-top: 5px;">
                            🚫 Be clear and specific about what is and isn't allowed.
                        </div>
                    </div>
                </div>

                <div style="padding: 20px; border-top: 1px solid #eee; display: flex; justify-content: flex-end; gap: 12px;">
                    <button wire:click="closeModal"
                            style="padding: 10px 20px; border: 1px solid #ddd; background: #f8f9fa; border-radius: 6px; cursor: pointer; font-size: 14px; transition: all 0.2s;"
                            onmouseover="this.style.backgroundColor='#e9ecef'"
                            onmouseout="this.style.backgroundColor='#f8f9fa'">
                        Cancel
                    </button>
                    <button wire:click="save"
                            style="padding: 10px 20px; border: none; background: #dc3545; color: white; border-radius: 6px; cursor: pointer; font-size: 14px; transition: background-color 0.2s;"
                            wire:loading.attr="disabled"
                            onmouseover="this.style.backgroundColor='#c82333'"
                            onmouseout="this.style.backgroundColor='#dc3545'">
                        <span wire:loading.remove">{{ $editingId ? 'Update' : 'Add' }}</span>
                        <span wire:loading>Saving...</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
