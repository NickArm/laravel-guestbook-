<!-- resources/views/livewire/property-sections/wifi-section.blade.php -->
<div class="card pb-2.5">
    <div class="card-header flex justify-between items-center">
        <h3 class="card-title">WiFi</h3>
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
            <label class="form-label max-w-56">WiFi Network</label>
            <div class="grow">
                <input wire:model="wifi_network"
                       class="input @error('wifi_network') border-red-500 @enderror"
                       type="text"
                       placeholder="lias_wifi">
                @error('wifi_network')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-56">WiFi Password</label>
            <div class="grow">
                <input wire:model="wifi_password"
                       class="input @error('wifi_password') border-red-500 @enderror"
                       type="text"
                       placeholder="lias_password">
                @error('wifi_password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-56">WiFi Description</label>
            <div class="grow">
                <textarea wire:model="wifi_description"
                          class="input @error('wifi_description') border-red-500 @enderror"
                          rows="3"
                          placeholder="Please enjoy our 100Mbps superfast free Wi-Fi"></textarea>
                @error('wifi_description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>
