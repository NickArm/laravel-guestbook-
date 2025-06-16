<!-- resources/views/livewire/property-sections/settings-section.blade.php -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Property Settings</h3>
        <div class="flex items-center gap-3">
            <button wire:click="saveSettings"
                    class="btn btn-sm btn-primary"
                    wire:loading.attr="disabled"
                    wire:target="saveSettings">
                <span wire:loading.remove wire:target="saveSettings">
                    <i class="ki-duotone ki-check fs-5 me-1"></i>
                    Save
                </span>
                <span wire:loading wire:target="saveSettings">
                    <i class="ki-duotone ki-arrows-circle animate-spin fs-5 me-1"></i>
                    Saving...
                </span>
            </button>
        </div>
    </div>

    <div class="card-body p-0">
        <!-- Flash Messages -->
        @if (session()->has('success'))
            <div class="alert alert-success mx-6 mt-6">
                <i class="ki-duotone ki-check-circle fs-4 me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger mx-6 mt-6">
                <i class="ki-duotone ki-cross-circle fs-4 me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Logo Upload Section -->
        <div class="border-b border-gray-200 p-4">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                    <i class="ki-duotone ki-picture fs-4 text-primary"></i>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-gray-900">Property Logo</h4>
                    <p class="text-sm text-gray-600">Upload your property logo for branding</p>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-6 p-8">
                <!-- Current Logo Display -->
                <div class="space-y-3">
                    <label class="form-label text-sm font-medium">Current Logo</label>
                    <div class="border-2 border-dashed border-gray-200 rounded-lg p-8 bg-gray-50 min-h-[140px] flex items-center justify-center">
                        @if($current_logo_url)
                            <div class="text-center">
                                <img src="{{ $current_logo_url }}"
                                     alt="Property Logo"
                                     class="max-w-full max-h-20 mx-auto mb-4 rounded-lg shadow-sm">
                                <button wire:click="removeLogo"
                                        class="btn btn-sm btn-light-danger"
                                        onclick="return confirm('Are you sure you want to remove the logo?')">
                                    <i class="ki-duotone ki-trash fs-6 me-1"></i>
                                    Remove
                                </button>
                            </div>
                        @else
                            <div class="text-center text-gray-500">
                                <div class="w-12 h-12 mx-auto mb-3 flex items-center justify-center rounded-full bg-gray-100">
                                    <i class="ki-duotone ki-picture fs-2 text-gray-400"></i>
                                </div>
                                <p class="text-sm font-medium">No logo uploaded</p>
                                <p class="text-xs text-gray-400">Upload a logo to brand your property</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Logo Upload -->
                <div class="space-y-4">
                    <label class="form-label text-sm font-medium">Upload New Logo</label>

                    <div class="space-y-4">
                        <input type="file"
                               wire:model="logo"
                               accept="image/*"
                               class="form-control">

                        @error('logo')
                            <div class="text-danger text-sm">{{ $message }}</div>
                        @enderror

                        <!-- Preview New Logo -->
                        @if ($logo)
                            <div class="border border-blue-200 rounded-lg p-4 bg-blue-50">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $logo->temporaryUrl() }}"
                                         class="w-12 h-12 rounded-lg object-cover">
                                    <div>
                                        <p class="text-sm font-medium text-blue-900">Preview</p>
                                        <p class="text-xs text-blue-600">Ready to upload</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <button wire:click="uploadLogo"
                                class="btn btn-primary w-full"
                                wire:loading.attr="disabled"
                                wire:target="uploadLogo"
                                {{ !$logo ? 'disabled' : '' }}>
                            <span wire:loading.remove wire:target="uploadLogo">
                                <i class="ki-duotone ki-cloud-upload fs-5 me-2"></i>
                                Upload Logo
                            </span>
                            <span wire:loading wire:target="uploadLogo">
                                <i class="ki-duotone ki-arrows-circle animate-spin fs-5 me-2"></i>
                                Uploading...
                            </span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="mt-6 p-4 bg-amber-50 border border-amber-200 rounded-lg">
                <div class="flex items-start gap-3">
                    <i class="ki-duotone ki-information fs-4 text-amber-600 mt-0.5"></i>
                    <div class="text-sm text-amber-800">
                        <p class="font-medium mb-1">Upload Guidelines</p>
                        <p>PNG or JPG format, max 2MB. Square dimensions (1:1 ratio) work best for consistent display across all devices.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Color Settings Section -->
        <div class="p-4">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                    <i class="ki-duotone ki-color-swatch fs-4 text-primary"></i>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-gray-900">Brand Colors</h4>
                    <p class="text-sm text-gray-600">Customize your property's color scheme</p>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-6 p-8">
                <!-- Primary Color -->
                <div class="space-y-3">
                    <label class="form-label text-sm font-medium">Primary Color</label>
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <input type="color"
                                   wire:model.live="primary_color"
                                   class="w-12 h-12 border border-gray-300 rounded-lg cursor-pointer">

                        </div>
                        <input type="text"
                               wire:model.live="primary_color"
                               class="form-control flex-1"
                               placeholder="#3b82f6">
                    </div>
                    @error('primary_color')
                        <div class="text-danger text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Secondary Color -->
                <div class="space-y-3">
                    <label class="form-label text-sm font-medium">Secondary Color</label>
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <input type="color"
                                   wire:model.live="secondary_color"
                                   class="w-12 h-12 border border-gray-300 rounded-lg cursor-pointer">
                        </div>
                        <input type="text"
                               wire:model.live="secondary_color"
                               class="form-control flex-1"
                               placeholder="#6b7280">
                    </div>
                    @error('secondary_color')
                        <div class="text-danger text-sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <!-- Color Usage Guide -->
            <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <div class="flex items-start gap-3">
                    <i class="ki-duotone ki-information-2 fs-4 text-blue-600 mt-0.5"></i>
                    <div class="text-sm text-blue-800">
                        <p class="font-medium mb-2">How Colors Are Applied</p>
                        <div class="space-y-1 text-blue-700">
                            <p>• <strong>Primary Color:</strong> Main call-to-action buttons, navigation highlights, and key interactive elements</p>
                            <p>• <strong>Secondary Color:</strong> Supporting text, icons, and subtle accents throughout your listing</p>
                            <p>• Colors are automatically applied to your property's public listing page for consistent branding</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blog Settings -->
        <div class="p-4 border-t border-gray-200">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                    <i class="ki-duotone ki-blog fs-4 text-primary"></i>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-gray-900">Blog Integration</h4>
                    <p class="text-sm text-gray-600">Control blog feed visibility and source</p>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-6 p-8">
                <div class="space-y-3">
                    <label class="form-label">Blog Feed URL</label>
                    <input type="text" wire:model.defer="blog_url" class="form-control" placeholder="https://yourdomain.com/wp-json/wp/v2/posts?...">
                    @error('blog_url') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="flex items-center gap-4">
                    <label class="switch">
                        <input type="checkbox" wire:model.live="blog_enabled">
                        <span class="switch-label">Enabled</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
