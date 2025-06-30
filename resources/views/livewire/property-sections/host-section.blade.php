<div class="card pb-2.5">
    <div class="card-header flex justify-between items-center">
        <h3 class="card-title">Host</h3>
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

    @if ($errors->any())
        <div class="alert alert-danger mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card-body grid gap-5">
        <!-- Name -->
        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-56">Name</label>
            <div class="grow">
                <input wire:model.defer="name"
                       class="input w-full @error('name') border-red-500 @enderror"
                       type="text"
                       placeholder="Host name">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Photo Upload -->
        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-56">Photo</label>
            <div class="grow">
                <input type="file" wire:model="photoFile" accept="image/*" class="input w-full">
                @if ($photo)
                    <img src="{{ $photo }}" class="h-20 mt-2 rounded border">
                @endif
                @error('photoFile')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Message -->
        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-56">Message</label>
            <div class="grow">
                <textarea wire:model.defer="message"
                          class="h-32 input @error('message') border-red-500 @enderror"
                          rows="4"
                          placeholder="Write a welcome message for your guests..."></textarea>
                @error('message')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Contact Methods -->
        <div class="flex items-start flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-56">Contact Methods</label>
            <div class="grow">
                @foreach ($contacts as $index => $contact)
                    <div class="flex gap-2 mb-2">
                        <select wire:model.defer="contacts.{{ $index }}.type" class="select">
                            <option value="">Select Type</option>
                            <option value="email">Email</option>
                            <option value="website">Website</option>
                            <option value="viber">Viber</option>
                            <option value="whatsapp">WhatsApp</option>
                            <option value="instagram">Instagram</option>
                            <option value="phone">Phone</option>
                        </select>

                        <input type="text"
                               wire:model.defer="contacts.{{ $index }}.value"
                               class="input grow"
                               placeholder="Value">

                        <button type="button"
                                wire:click="removeContactMethod({{ $index }})"
                                class="btn btn-sm btn-light text-red-500">✕</button>
                    </div>
                @endforeach

                <button type="button"
                        wire:click="addContactMethod"
                        class="btn btn-sm btn-secondary mt-2">+ Add Contact Method</button>
            </div>
        </div>
    </div>
</div>
