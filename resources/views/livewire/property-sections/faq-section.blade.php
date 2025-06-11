<div class="card pb-2.5">
    <div class="card-header flex justify-between items-center">
        <h3 class="card-title">FAQs</h3>
        <div class="flex items-center gap-4">
            <label class="switch">
                <input type="checkbox" wire:model="enabled">
                <span class="switch-label">Enabled</span>
            </label>
            <button wire:click="openModal" class="btn btn-sm btn-primary">
                <i class="ki-outline ki-plus"></i>
                Add FAQ
            </button>
        </div>
    </div>

    <div class="card-body">
        @if($property->faqs && $property->faqs->count())
            <div class="grid gap-4">
                @foreach($property->faqs as $faq)
                    <div class="border rounded p-4 relative hover:bg-gray-50">
                        <div class="flex justify-between items-start">
                            <div class="grow">
                                <h4 class=" text-lg mb-2">{{ $faq->question }}</h4>
                                <div class="text-gray-600 leading-relaxed whitespace-pre-line">
                                    {{ $faq->answer }}
                                </div>
                            </div>

                            <div class="flex gap-2 ml-4 flex-shrink-0">
                                <button wire:click="editFaq({{ $faq->id }})" class="btn btn-xs btn-secondary">
                                    <i class="ki-outline ki-pencil"></i> Edit
                                </button>
                                <button wire:click="deleteFaq({{ $faq->id }})"
                                        class="btn btn-xs btn-danger"
                                        onclick="confirm('Are you sure you want to delete this FAQ?') || event.stopImmediatePropagation()">
                                    <i class="ki-outline ki-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8 text-gray-500">
                <i class="ki-outline ki-questionnaire-tablet text-3xl mb-2"></i>
                <p class="text-lg mb-2">No FAQs added yet.</p>
                <p class="text-sm mb-4">Create helpful answers for common guest questions.</p>
                <button wire:click="openModal" class="btn btn-sm btn-primary">
                    <i class="ki-outline ki-plus"></i> Add First FAQ
                </button>
            </div>
        @endif
    </div>

    @if($showModal)
<div wire:ignore.self class="fixed inset-0 bg-black bg-opacity-50 z-[9999] flex items-center justify-center p-8" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 99999; display: flex; align-items: center; justify-content: center; padding: 20px; box-sizing: border-box;">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl max-h-[90vh] overflow-y-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">{{ $editingId ? 'Edit FAQ' : 'Add FAQ' }}</h3>
            <button wire:click="closeModal" class="btn btn-sm btn-circle btn-ghost">✕</button>
        </div>

        <div class="grid gap-4">
            <div>
                <label class="form-label">Question</label>
                <input wire:model.defer="question" class="input w-full @error('question') border-red-500 @enderror" type="text" placeholder="What time is check-in?">
                @error('question') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="form-label">Answer</label>
                <textarea wire:model.defer="answer" class="input w-full @error('answer') border-red-500 @enderror" rows="5" placeholder="Check-in is available from 3:00 PM..."></textarea>
                @error('answer') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-2">
            <button wire:click="closeModal" class="btn btn-ghost">Cancel</button>
            <button wire:click="save" class="btn btn-primary" wire:loading.attr="disabled">
                <span wire:loading.remove>{{ $editingId ? 'Update' : 'Add' }}</span>
                <span wire:loading>Saving...</span>
            </button>
        </div>
    </div>
</div>
@endif

</div>
