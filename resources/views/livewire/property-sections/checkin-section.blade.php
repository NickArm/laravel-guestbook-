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
                        <textarea
                        wire:model="check_in_instructions"
                        rows="4"
                        placeholder="Check-in instructions for guests"
                        class="w-full min-h-[120px] bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-primary focus:border-primary p-4 pt-5 @error('check_in_instructions') border-red-500 @enderror"
                        ></textarea>

                        @error('check_in_instructions')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                 <!-- Video -->
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label max-w-56">Check In Video URL</label>
                    <div class="grow">
                        <input wire:model="checkin_video" class="input @error('checkin_video') border-red-500 @enderror" type="url" placeholder="https://www.youtube.com/watch?v=...">
                        @error('checkin_video')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
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
                        <textarea
                        wire:model="check_out_instructions"
                        rows="4"
                        placeholder="Check-out instructions for guests"
                        class="w-full min-h-[120px] bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-primary focus:border-primary p-4 pt-5 @error('check_out_instructions') border-red-500 @enderror"
                        ></textarea>
                        @error('check_out_instructions')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Video -->
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label max-w-56">Check Out Video URL</label>
                    <div class="grow">
                        <input wire:model="checkout_video" class="input @error('checkout_video') border-red-500 @enderror" type="url" placeholder="https://www.youtube.com/watch?v=...">
                        @error('checkout_video')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
