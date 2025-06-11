<div class="card pb-2.5">
    <div class="card-header flex justify-between items-center">
        <h3 class="card-title">Check In/Out</h3>
        <div class="flex items-center gap-4">
            <label class="switch">
                <input type="checkbox" wire:model="enabled">
                <span class="switch-label">Enabled</span>
            </label>
            <button wire:click="save" class="btn btn-sm btn-primary" wire:loading.attr="disabled">
                <span wire:loading.remove">Save</span>
                <span wire:loading>Saving...</span>
            </button>
        </div>
    </div>

    <div class="card-body grid gap-5">
        <!-- Check In Section -->
        <div class="border rounded p-4">
            <h4 class="text-lg font-semibold mb-4">Check In Information</h4>

            <div class="grid gap-4">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label max-w-56">Check In Time</label>
                    <div class="grow">
                        <input wire:model="check_in_time"
                               class="input @error('check_in_time') border-red-500 @enderror"
                               type="text"
                               placeholder="3:00 PM">
                        @error('check_in_time')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label max-w-56">Check In Instructions</label>
                    <div class="grow">
                        <textarea wire:model="check_in_instructions"
                                  class="input @error('check_in_instructions') border-red-500 @enderror"
                                  rows="4"
                                  placeholder="Check in instructions for guests"></textarea>
                        @error('check_in_instructions')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Check Out Section -->
        <div class="border rounded p-4">
            <h4 class="text-lg font-semibold mb-4">Check Out Information</h4>

            <div class="grid gap-4">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label max-w-56">Check Out Time</label>
                    <div class="grow">
                        <input wire:model="check_out_time"
                               class="input @error('check_out_time') border-red-500 @enderror"
                               type="text"
                               placeholder="11:00 AM">
                        @error('check_out_time')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label max-w-56">Check Out Instructions</label>
                    <div class="grow">
                        <textarea wire:model="check_out_instructions"
                                  class="input @error('check_out_instructions') border-red-500 @enderror"
                                  rows="4"
                                  placeholder="Check out instructions for guests"></textarea>
                        @error('check_out_instructions')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Preview when enabled -->
        @if($enabled)
            <div class="border rounded p-4 bg-gray-50">
                <h4 class="text-lg font-semibold mb-4">Preview</h4>
                <div class="grid gap-4">
                    @if($check_in_time || $check_in_instructions)
                        <div>
                            <h5 class="font-medium mb-2">Check In</h5>
                            @if($check_in_time)
                                <p class="text-sm"><strong>Time:</strong> {{ $check_in_time }}</p>
                            @endif
                            @if($check_in_instructions)
                                <p class="text-sm mt-2">{{ $check_in_instructions }}</p>
                            @endif
                        </div>
                    @endif

                    @if($check_out_time || $check_out_instructions)
                        <div>
                            <h5 class="font-medium mb-2">Check Out</h5>
                            @if($check_out_time)
                                <p class="text-sm"><strong>Time:</strong> {{ $check_out_time }}</p>
                            @endif
                            @if($check_out_instructions)
                                <p class="text-sm mt-2">{{ $check_out_instructions }}</p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
