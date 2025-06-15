<div class="card pb-2.5">
    <div class="card-header flex justify-between items-center">
        <h3 class="card-title">Before You Go</h3>
        <div class="flex items-center gap-4">
            <label class="switch">
                <input type="checkbox" wire:model="enabled">
                <span class="switch-label">Enabled</span>
            </label>
            <button wire:click="addNote" class="btn btn-sm btn-primary">
                <i class="ki-outline ki-plus"></i>
                Add Note
            </button>
        </div>
    </div>

    <div class="card-body">
        @if($notes && count($notes))
            <div class="grid gap-4">
                @foreach($notes as $index => $note)
                    <div class="border rounded p-4 bg-gray-50 relative">
                        <div class="flex justify-between items-start gap-4">
                            <div class="grow">
                                <label class="form-label text-sm text-gray-600 block mb-1">Note {{ $index + 1 }}</label>
                                <textarea wire:model.defer="notes.{{ $index }}.content"
                                          rows="3"
                                          class="input w-full @error('notes.' . $index . '.content') border-red-500 @enderror"
                                          placeholder="Type note..."></textarea>
                                @error('notes.' . $index . '.content')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex-shrink-0 mt-6">
                                <button wire:click="removeNote({{ $index }})"
                                        class="btn btn-xs btn-danger"
                                        onclick="confirm('Are you sure you want to delete this note?') || event.stopImmediatePropagation()">
                                    <i class="ki-outline ki-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8 text-gray-500">
                <i class="ki-outline ki-document text-3xl mb-2"></i>
                <p class="text-lg mb-2">No Rules added yet.</p>
                <p class="text-sm mb-4">Add useful reminders or information for your guests.</p>
                <button wire:click="addNote" class="btn btn-sm btn-primary">
                    <i class="ki-outline ki-plus"></i> Add First Note
                </button>
            </div>
        @endif

        <div class="mt-4 flex justify-end">
            <button wire:click="save" class="btn btn-sm btn-primary" wire:loading.attr="disabled">
                <span wire:loading.remove>Save All</span>
                <span wire:loading>Saving...</span>
            </button>
        </div>
    </div>
</div>
