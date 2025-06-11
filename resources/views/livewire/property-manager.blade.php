<div>
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <div class="container-fixed">
        <div class="flex grow gap-5 lg:gap-7.5">
            <!-- Sidebar Navigation -->
            <div class="hidden lg:block w-[230px] shrink-0">
                <div class="w-[230px]" data-sticky="true" data-sticky-animation="true"
                     data-sticky-class="fixed z-[4] left-auto top-[calc(var(--tw-header-height)+1rem)]"
                     data-sticky-name="scrollspy" data-sticky-offset="200" data-sticky-target="body">
                    <div class="flex flex-col grow relative before:absolute before:left-[11px] before:top-0 before:bottom-0 before:border-l before:border-gray-200">

                        <!-- Home Section -->
                        <button wire:click="setActiveSection('home')"
                                class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm
                                       {{ $activeSection === 'home' ? 'bg-secondary-active text-primary font-medium' : 'text-gray-800 hover:text-primary hover:font-medium' }}">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4
                                         {{ $activeSection === 'home' ? 'before:bg-primary' : '' }}"></span>
                            Home
                        </button>

                        <!-- Check In/Out Section -->
                        <button wire:click="setActiveSection('checkin')"
                                class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm
                                       {{ $activeSection === 'checkin' ? 'bg-secondary-active text-primary font-medium' : 'text-gray-800 hover:text-primary hover:font-medium' }}">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4
                                         {{ $activeSection === 'checkin' ? 'before:bg-primary' : '' }}"></span>
                            Check In/Out
                        </button>

                        <!-- Amenities Section -->
                        <button wire:click="setActiveSection('amenities')"
                                class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm
                                       {{ $activeSection === 'amenities' ? 'bg-secondary-active text-primary font-medium' : 'text-gray-800 hover:text-primary hover:font-medium' }}">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4
                                         {{ $activeSection === 'amenities' ? 'before:bg-primary' : '' }}"></span>
                            Amenities & Appliances
                        </button>

                        <!-- WiFi Section -->
                        <button wire:click="setActiveSection('wifi')"
                                class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm
                                       {{ $activeSection === 'wifi' ? 'bg-secondary-active text-primary font-medium' : 'text-gray-800 hover:text-primary hover:font-medium' }}">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4
                                         {{ $activeSection === 'wifi' ? 'before:bg-primary' : '' }}"></span>
                            WiFi
                        </button>

                        <!-- Location Section -->
                        <button wire:click="setActiveSection('location')"
                                class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm
                                       {{ $activeSection === 'location' ? 'bg-secondary-active text-primary font-medium' : 'text-gray-800 hover:text-primary hover:font-medium' }}">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4
                                         {{ $activeSection === 'location' ? 'before:bg-primary' : '' }}"></span>
                            Location
                        </button>

                        <!-- Transportation Section -->
                        <button wire:click="setActiveSection('transportation')"
                                class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm
                                       {{ $activeSection === 'transportation' ? 'bg-secondary-active text-primary font-medium' : 'text-gray-800 hover:text-primary hover:font-medium' }}">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4
                                         {{ $activeSection === 'transportation' ? 'before:bg-primary' : '' }}"></span>
                            Transportation
                        </button>

                        <!-- Rules Section -->
                        <button wire:click="setActiveSection('rules')"
                                class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm
                                       {{ $activeSection === 'rules' ? 'bg-secondary-active text-primary font-medium' : 'text-gray-800 hover:text-primary hover:font-medium' }}">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4
                                         {{ $activeSection === 'rules' ? 'before:bg-primary' : '' }}"></span>
                            Rules
                        </button>

                        <!-- FAQs Section -->
                        <button wire:click="setActiveSection('faq')"
                                class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm
                                       {{ $activeSection === 'faq' ? 'bg-secondary-active text-primary font-medium' : 'text-gray-800 hover:text-primary hover:font-medium' }}">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4
                                         {{ $activeSection === 'faq' ? 'before:bg-primary' : '' }}"></span>
                            FAQs
                        </button>

                        <!-- Gallery Section -->
                        <button wire:click="setActiveSection('gallery')"
                                class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm
                                       {{ $activeSection === 'gallery' ? 'bg-secondary-active text-primary font-medium' : 'text-gray-800 hover:text-primary hover:font-medium' }}">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4
                                         {{ $activeSection === 'gallery' ? 'before:bg-primary' : '' }}"></span>
                            Gallery
                        </button>

                        <!-- Review Section -->
                        <button wire:click="setActiveSection('review')"
                                class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm
                                       {{ $activeSection === 'review' ? 'bg-secondary-active text-primary font-medium' : 'text-gray-800 hover:text-primary hover:font-medium' }}">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4
                                         {{ $activeSection === 'review' ? 'before:bg-primary' : '' }}"></span>
                            Review
                        </button>

                        <!-- Before You Go Section -->
                        <button wire:click="setActiveSection('before-you-go')"
                                class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm
                                       {{ $activeSection === 'before-you-go' ? 'bg-secondary-active text-primary font-medium' : 'text-gray-800 hover:text-primary hover:font-medium' }}">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4
                                         {{ $activeSection === 'before-you-go' ? 'before:bg-primary' : '' }}"></span>
                            Before You Go
                        </button>

                        <!-- Recommendations Section -->
                        <button wire:click="setActiveSection('recommendations')"
                                class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm
                                       {{ $activeSection === 'recommendations' ? 'bg-secondary-active text-primary font-medium' : 'text-gray-800 hover:text-primary hover:font-medium' }}">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4
                                         {{ $activeSection === 'recommendations' ? 'before:bg-primary' : '' }}"></span>
                            Recommendations
                        </button>

                        <!-- Settings/Branding Section -->
                        <button wire:click="setActiveSection('settings')"
                                class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm
                                       {{ $activeSection === 'settings' ? 'bg-secondary-active text-primary font-medium' : 'text-gray-800 hover:text-primary hover:font-medium' }}">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4
                                         {{ $activeSection === 'settings' ? 'before:bg-primary' : '' }}"></span>
                            Branding
                        </button>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="flex flex-col items-stretch grow gap-5 lg:gap-7.5">

                <!-- Home Section -->
                @if($activeSection === 'home')
                    @livewire('property-sections.home-section', ['property' => $property], key('home-'.($property->id ?? 'new')))
                @endif

                <!-- Check In/Out Section -->
                @if($activeSection === 'checkin')
                    @livewire('property-sections.checkin-section', ['property' => $property], key('checkin-'.($property->id ?? 'new')))
                @endif

                <!-- Amenities Section -->
                @if($activeSection === 'amenities')
                    @livewire('property-sections.amenities-section', ['property' => $property], key('amenities-'.($property->id ?? 'new')))
                    @livewire('property-sections.appliances-section', ['property' => $property], key('appliances-'.($property->id ?? 'new')))
                @endif

                <!-- WiFi Section -->
                @if($activeSection === 'wifi')
                    @livewire('property-sections.wifi-section', ['property' => $property], key('wifi-'.($property->id ?? 'new')))
                @endif

                <!-- Location Section -->
                @if($activeSection === 'location')
                    @livewire('property-sections.location-section', ['property' => $property], key('location-'.($property->id ?? 'new')))
                @endif

                <!-- Transportation Section -->
                @if($activeSection === 'transportation')
                    @livewire('property-sections.transportation-section', ['property' => $property], key('transportation-'.($property->id ?? 'new')))
                @endif

                <!-- Rules Section -->
                @if($activeSection === 'rules')
                    @livewire('property-sections.rules-section', ['property' => $property], key('rules-'.($property->id ?? 'new')))
                @endif

                <!-- FAQs Section -->
                @if($activeSection === 'faq')
                    @livewire('property-sections.faq-section', ['property' => $property], key('faq-'.($property->id ?? 'new')))
                @endif

                <!-- Gallery Section -->
                @if($activeSection === 'gallery')
                    @livewire('property-sections.gallery-section', ['property' => $property], key('gallery-'.($property->id ?? 'new')))
                @endif

                <!-- Review Section -->
                @if($activeSection === 'review')
                    @livewire('property-sections.review-section', ['property' => $property], key('review-'.($property->id ?? 'new')))
                @endif

                <!-- Before You Go Section -->
                @if($activeSection === 'before-you-go')
                    @livewire('property-sections.before-you-go-section', ['property' => $property], key('before-you-go-'.($property->id ?? 'new')))
                @endif

                <!-- Recommendations Section -->
                @if($activeSection === 'recommendations')
                    @livewire('property-sections.recommendations-section', ['property' => $property], key('recommendations-'.($property->id ?? 'new')))
                @endif

                <!-- Settings/Branding Section -->
                @if($activeSection === 'settings')
                    @livewire('property-sections.settings-section', ['property' => $property], key('settings-'.($property->id ?? 'new')))
                @endif

            </div>
        </div>
    </div>
</div>
