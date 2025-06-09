<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    <div class="container-fixed">
        <div class="flex grow gap-5 lg:gap-7.5">
            <!-- Sidebar -->
            <div class="hidden lg:block w-[230px] shrink-0">
               <div class="w-[230px]" data-sticky="true" data-sticky-animation="true" data-sticky-class="fixed z-[4] left-auto top-[calc(var(--tw-header-height)+1rem)]" data-sticky-name="scrollspy" data-sticky-offset="200" data-sticky-target="body">
                    <div class="flex flex-col grow relative before:absolute before:left-[11px] before:top-0 before:bottom-0 before:border-l before:border-gray-200" data-scrollspy="true" data-scrollspy-offset="80px|lg:110px" data-scrollspy-target="body">
                        <a class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm text-gray-800 hover:text-primary hover:font-medium scrollspy-active:bg-secondary-active scrollspy-active:text-primary scrollspy-active:font-medium dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg dark:scrollspy-active:bg-coal-300 dark:scrollspy-active:border-gray-100" data-scrollspy-anchor="true" href="#section_home">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4 scrollspy-active:before:bg-primary">
                            </span>
                            Home
                        </a>
                        <a class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm text-gray-800 hover:text-primary hover:font-medium scrollspy-active:bg-secondary-active scrollspy-active:text-primary scrollspy-active:font-medium dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg dark:scrollspy-active:bg-coal-300 dark:scrollspy-active:border-gray-100" data-scrollspy-anchor="true" href="#section_checkin">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4 scrollspy-active:before:bg-primary">
                            </span>
                            Check In/Out
                        </a>
                        <a class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm text-gray-800 hover:text-primary hover:font-medium scrollspy-active:bg-secondary-active scrollspy-active:text-primary scrollspy-active:font-medium dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg dark:scrollspy-active:bg-coal-300 dark:scrollspy-active:border-gray-100" data-scrollspy-anchor="true" href="#section_amenities">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4 scrollspy-active:before:bg-primary">
                            </span>
                            Amenities
                        </a>
                        <a class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm text-gray-800 hover:text-primary hover:font-medium scrollspy-active:bg-secondary-active scrollspy-active:text-primary scrollspy-active:font-medium dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg dark:scrollspy-active:bg-coal-300 dark:scrollspy-active:border-gray-100" data-scrollspy-anchor="true" href="#section_wifi">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4 scrollspy-active:before:bg-primary">
                            </span>
                            Wifi
                        </a>
                        <a class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm text-gray-800 hover:text-primary hover:font-medium scrollspy-active:bg-secondary-active scrollspy-active:text-primary scrollspy-active:font-medium dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg dark:scrollspy-active:bg-coal-300 dark:scrollspy-active:border-gray-100" data-scrollspy-anchor="true" href="#section_location">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4 scrollspy-active:before:bg-primary"></span>
                            Location
                        </a>
                        <a class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm text-gray-800 hover:text-primary hover:font-medium scrollspy-active:bg-secondary-active scrollspy-active:text-primary scrollspy-active:font-medium dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg dark:scrollspy-active:bg-coal-300 dark:scrollspy-active:border-gray-100" data-scrollspy-anchor="true" href="#section_transportation">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4 scrollspy-active:before:bg-primary"></span>
                            Transportation
                        </a>
                        <a class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm text-gray-800 hover:text-primary hover:font-medium scrollspy-active:bg-secondary-active scrollspy-active:text-primary scrollspy-active:font-medium dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg dark:scrollspy-active:bg-coal-300 dark:scrollspy-active:border-gray-100" data-scrollspy-anchor="true" href="#section_rules">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4 scrollspy-active:before:bg-primary">
                            </span>
                            Rules
                        </a>

                        <a class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm text-gray-800 hover:text-primary hover:font-medium scrollspy-active:bg-secondary-active scrollspy-active:text-primary scrollspy-active:font-medium dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg dark:scrollspy-active:bg-coal-300 dark:scrollspy-active:border-gray-100" data-scrollspy-anchor="true" href="#section_faq">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4 scrollspy-active:before:bg-primary">
                            </span>
                            FAQs
                        </a>

                        <a class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm text-gray-800 hover:text-primary hover:font-medium scrollspy-active:bg-secondary-active scrollspy-active:text-primary scrollspy-active:font-medium dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg dark:scrollspy-active:bg-coal-300 dark:scrollspy-active:border-gray-100" data-scrollspy-anchor="true" href="#section_gallery">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4 scrollspy-active:before:bg-primary">
                            </span>
                            Gallery
                        </a>

                         <a class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm text-gray-800 hover:text-primary hover:font-medium scrollspy-active:bg-secondary-active scrollspy-active:text-primary scrollspy-active:font-medium dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg dark:scrollspy-active:bg-coal-300 dark:scrollspy-active:border-gray-100" data-scrollspy-anchor="true" href="#section_review">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4 scrollspy-active:before:bg-primary">
                            </span>
                            Review
                        </a>

                        <a class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm text-gray-800 hover:text-primary hover:font-medium scrollspy-active:bg-secondary-active scrollspy-active:text-primary scrollspy-active:font-medium dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg dark:scrollspy-active:bg-coal-300 dark:scrollspy-active:border-gray-100" data-scrollspy-anchor="true" href="#section_before_you_go">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4 scrollspy-active:before:bg-primary">
                            </span>
                            Before You Go
                        </a>

                        <a class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm text-gray-800 hover:text-primary hover:font-medium scrollspy-active:bg-secondary-active scrollspy-active:text-primary scrollspy-active:font-medium dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg dark:scrollspy-active:bg-coal-300 dark:scrollspy-active:border-gray-100" data-scrollspy-anchor="true" href="#section_recommendations">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4 scrollspy-active:before:bg-primary">
                            </span>
                            Recommendations
                        </a>


                        <a class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 border border-transparent text-2sm text-gray-800 hover:text-primary hover:font-medium scrollspy-active:bg-secondary-active scrollspy-active:text-primary scrollspy-active:font-medium dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg dark:scrollspy-active:bg-coal-300 dark:scrollspy-active:border-gray-100" data-scrollspy-anchor="true" href="#section_settings">
                            <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4 scrollspy-active:before:bg-primary">
                            </span>
                            Appearance Settings
                        </a>

                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="flex flex-col items-stretch grow gap-5 lg:gap-7.55">
                <!-- Home Section -->
                <div class="card pb-2.5" id="section_home">
                    <div class="card-header">
                        <h3 class="card-title">Home</h3>
                    </div>
                    <div class="card-body grid gap-5">
                        @foreach([
                            ['name', 'Name'],
                            ['slug', 'Slug'],
                            ['address', 'Address'],
                            ['welcome_title', 'Welcome Title'],
                        ] as [$name, $label])
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-56">{{ $label }}</label>
                                <input class="input" type="text" name="{{ $name }}" value="{{ old($name, $property->$name ?? '') }}" required>
                            </div>
                        @endforeach
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-56">Google Maps Directions URL</label>
                                <input class="input" type="url" name="property_directions" value="{{ old('property_directions', $property->property_directions ?? '') }}">
                            </div>
                        @foreach([
                            ['welcome_message', 'Welcome Message'],
                        ] as [$name, $label])
                            @php
                                $value = old($name, $property->$name ?? '');
                            @endphp
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-56">{{ $label }}</label>
                                <div class="grow">
                                    <textarea id="{{ $name }}" name="{{ $name }}" class="summernote" required>{!! $value !!}</textarea>
                                    @error($name)
                                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        @endforeach




                    </div>

                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">Logo</label>
                         <input type="file" name="logo" id="logo" class="input" accept="image/*">
                        @if (!empty($property->logo_url))
                            <img src="{{ $property->logo_url }}" alt="Logo" class="w-28 mt-2 rounded border">
                        @endif
                    </div>

                </div>

                <!-- Amenities Section -->
                <div class="card pb-2.5" id="section_amenities">
                    <div class="card-header flex justify-between items-center">
                        <h3 class="card-title">Amenities</h3>
                        <label class="switch">
                            <input type="checkbox" name="enabled_pages[]" value="amenities"
                                {{ in_array('amenities', old('enabled_pages', $property->enabled_pages ?? [])) ? 'checked' : '' }}>
                            <span class="switch-label">Enabled</span>
                        </label>
                    </div>
                    <div class="card-body grid gap-5">
                        @foreach([
                            ['amenities_description', 'Amenities Description'],
                        ] as [$name, $label])
                            @php
                                $value = old($name, $property->$name ?? '');
                            @endphp
                                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                    <label class="form-label max-w-56">{{ $label }}</label>
                                    <div class="grow">
                                        <textarea id="amenities_description" name="amenities_description" class="summernote">
                                            {!! old('amenities_description', $property->amenities_description ?? '') !!}
                                        </textarea>
                                        @error($name)
                                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                        @endforeach

                    </div>
                </div>

                <!-- WiFi Section -->
                <div class="card pb-2.5" id="section_wifi">
                    <div class="card-header flex justify-between items-center">
                        <h3 class="card-title">WiFi</h3>
                        <label class="switch">
                            <input type="checkbox" name="enabled_pages[]" value="wifi"
                                {{ in_array('wifi', old('enabled_pages', $property->enabled_pages ?? [])) ? 'checked' : '' }}>
                            <span class="switch-label">Enabled</span>
                        </label>
                    </div>
                    <div class="card-body grid gap-5">
                        @php
                            $wifi = old('wifi');

                            if (!$wifi && isset($property) && $property->wifi) {
                                $wifi = [
                                    'network' => $property->wifi->network,
                                    'password' => $property->wifi->password,
                                    'description' => $property->wifi->description,
                                ];
                            } elseif (!$wifi) {
                                $wifi = [];
                            }
                        @endphp


                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">WiFi Network</label>
                            <input type="text" name="wifi[network]" class="input" value="{{ $wifi['network'] ?? '' }}">
                        </div>

                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">WiFi Password</label>
                            <input type="text" name="wifi[password]" class="input" value="{{ $wifi['password'] ?? '' }}">
                        </div>

                        @php
                            $wifiDescription = old('wifi.description', $wifi['description'] ?? '');
                        @endphp
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-56">WiFi Description</label>
                                <textarea class="input grow" name="wifi[description]" rows="3">{{ old('wifi.description', $wifi['description'] ?? '') }}</textarea>
                            </div>
                    </div>
                </div>


                <!-- Check In/Out Section -->
                <div class="card pb-2.5" id="section_checkin">
                    <div class="card-header">
                        <h3 class="card-title">Check In/Out</h3>
                    </div>
                    <div class="card-body grid gap-5">
                        @foreach([
                            ['checkin', 'Check-in'],
                            ['checkout', 'Check-out'],
                        ] as [$name, $label])
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-56">{{ $label }}</label>
                                <input class="input" type="text" name="{{ $name }}" value="{{ old($name, $property->$name ?? '') }}" required>
                            </div>
                        @endforeach

                        @foreach([
                            ['checkin_instructions', 'Check-in Instructions'],
                            ['checkout_instructions', 'Check-out Instructions'],
                        ] as [$name, $label])
                            @php
                                $value = old($name, $property->$name ?? '');
                            @endphp
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-56">{{ $label }}</label>
                                <div class="grow">
                                    <textarea class="input" name="{{ $name }}" rows="3" required>{{ $value }}</textarea>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Add a new Location section -->
                <div class="card pb-2.5" id="section_location">
                    <div class="card-header">
                        <h3 class="card-title">Location</h3>
                    </div>
                    <div class="card-body grid gap-5">
                        @foreach([
                            ['location_area', 'Location Area'],
                            ['location_country', 'Location Country'],
                            ['google_map_url', 'Google Map URL'],
                        ] as [$name, $label])
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-56">{{ $label }}</label>
                                <input
                                    class="input @error($name) border-red-500 @enderror"
                                    type="text"
                                    name="{{ $name }}"
                                    value="{{ old($name, $property->$name ?? '') }}"
                                    {{ $name !== 'google_map_url' ? 'required' : '' }}
                                >
                                @error($name)
                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach

                        @php $name = 'location_description'; $label = 'Location Description'; @endphp
                            @php
                                $value = old($name, $property->$name ?? '');
                            @endphp
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-56">{{ $label }}</label>
                                <div class="grow">
                                    <textarea class="input" name="{{ $name }}" rows="3" required>{{ $value }}</textarea>
                                </div>
                            </div>
                    </div>
                </div>

                <!-- Transportation Section -->
                <div class="card pb-2.5" id="section_transportation">
                    <div class="card-header flex justify-between items-center">
                        <h3 class="card-title">Transportation</h3>
                        <label class="switch">
                            <input type="checkbox" name="enabled_pages[]" value="transportation"
                                {{ in_array('transportation', old('enabled_pages', $property->enabled_pages ?? [])) ? 'checked' : '' }}>
                            <span class="switch-label">Enabled</span>
                        </label>
                    </div>
                    <div class="card-body grid gap-5">
                        <div id="transportation-container" class="grid gap-4">
                            @php
                                $transportationItems = old('transportation', isset($property) && $property->transportation ? $property->transportation->toArray() : []);
                            @endphp

                            @foreach($transportationItems as $index => $t)
                                <div class="transportation-group grid gap-2 pl-8 p-4 border rounded-md bg-gray-50 relative">
                                    <button type="button" class="absolute rounded-md right-2 text-red-600 remove-transportation" title="Remove">&times;</button>
                                    <input type="text" name="transportation[{{ $index }}][title]" class="input" placeholder="Title" value="{{ $t['title'] ?? '' }}">
                                    <input type="text" name="transportation[{{ $index }}][description]" class="input" placeholder="Description" value="{{ $t['description'] ?? '' }}">
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-transportation-btn" class="btn btn-sm btn-light mt-4">+ Add Transportation</button>
                    </div>
                </div>


                <!-- Rules Section -->
                <div class="card pb-2.5" id="section_rules">
                    <div class="card-header flex justify-between items-center">
                        <h3 class="card-title">Rules</h3>
                        <label class="switch">
                            <input type="checkbox" name="enabled_pages[]" value="rules"
                                {{ in_array('rules', old('enabled_pages', $property->enabled_pages ?? [])) ? 'checked' : '' }}>
                            <span class="switch-label">Enabled</span>
                        </label>
                    </div>
                    <div class="card-body grid gap-5">
                        <div id="rules-container" class="grid gap-4">
                            @php
                                $rulesItems = old('rules', isset($property) && $property->rules ? $property->rules->toArray() : []);
                            @endphp

                            @foreach($rulesItems as $index => $rule)

                                <div class="rule-group grid gap-2 pl-8 p-4 border rounded-md bg-gray-50 relative">
                                    <button type="button" class="absolute rounded-md right-2 text-red-600 remove-rule" title="Remove">&times;</button>
                                    <input type="text" name="rules[{{ $index }}][title]" placeholder="Title" class="input" value="{{ $rule['title'] ?? '' }}">
                                    <input type="text" name="rules[{{ $index }}][description]" placeholder="Description" class="input" value="{{ $rule['description'] ?? '' }}">
                                </div>
                            @endforeach

                        </div>
                        <button type="button" id="add-rule-btn" class="btn btn-sm btn-light mt-4">+ Add Rule</button>
                    </div>
                </div>

                <!-- FAQs Section -->
                <div class="card pb-2.5" id="section_faq">
                    <div class="card-header flex justify-between items-center">
                        <h3 class="card-title">FAQs</h3>
                        <label class="switch switch-sm">
                            <span class="switch-label">Show</span>
                            <input type="checkbox" name="enabled_pages[]" value="faq"
                                {{ in_array('faq', old('enabled_pages', $property->enabled_pages ?? [])) ? 'checked' : '' }}>
                        </label>
                    </div>
                    <div class="card-body grid gap-5">
                        <div id="faqs-container" class="grid gap-4">
                            @php
                                $faqItems = old('faqs', isset($property) && $property->faqs ? $property->faqs->toArray() : []);
                            @endphp

                            @foreach($faqItems as $index => $faq)

                                <div class="faq-group grid gap-2 pl-8 p-4 border rounded-md bg-gray-50 relative">
                                    <button type="button" class="absolute rounded-md right-2 text-red-600 remove-faq" title="Remove">&times;</button>
                                    <input type="text" name="faqs[{{ $index }}][question]" class="input" placeholder="Question"
                                        value="{{ $faq['question'] ?? '' }}">
                                    <input type="text" name="faqs[{{ $index }}][answer]" class="input" placeholder="Answer"
                                        value="{{ $faq['answer'] ?? '' }}">
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-faq-btn" class="btn btn-sm btn-light mt-4">+ Add FAQ</button>
                    </div>
                </div>

                <!-- Gallery Images -->
                <div class="card pb-2.5" id="section_gallery">
                    <div class="card-header">
                        <h3 class="card-title">Gallery Photos</h3>
                    </div>
                    <div class="card-body grid gap-5">
                        <!-- Upload Field -->
                        <div class="flex flex-col gap-2">
                            <label class="form-label">Gallery Images (max 10)</label>
                            <input type="file" name="gallery[]" multiple accept="image/*" class="input" />
                        </div>

                        <!-- Existing Images -->
                        @php
                            $images = isset($property) && $property->images ? $property->images : collect();
                        @endphp

                        @if ($images->count())
                            <div class="flex flex-wrap gap-3 mt-4">

                                @foreach ($property->images as $image)
                                    <div class="relative group border rounded overflow-hidden w-28 h-28">
                                                                            <button
                                            data-image-id="{{ $image->id }}"
                                            class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center hover:bg-red-700 delete-image-btn"
                                            title="Delete Image"
                                        >
                                            &times;
                                        </button>
                                        <img src="{{ $image->url }}" alt="Gallery Image" class="w-full h-full object-cover" />


                                    </div>

                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Review Section -->
                <div class="card pb-2.5" id="section_review">
                    <div class="card-header flex justify-between items-center">
                        <h3 class="card-title">Review</h3>
                        <label class="switch">
                            <input type="checkbox" name="enabled_pages[]" value="review"
                                {{ in_array('review', old('enabled_pages', $property->enabled_pages ?? [])) ? 'checked' : '' }}>
                            <span class="switch-label">Enabled</span>
                        </label>
                    </div>
                    <div class="card-body grid gap-5">
                        @php
                            $review = old('review', $property->review ?? []);
                        @endphp

                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">Short Description</label>
                            <input type="text" name="review[description]" class="input" value="{{ $review['description'] ?? '' }}">
                        </div>

                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">Review URL</label>
                            <input type="url" name="review[url]" class="input" value="{{ $review['url'] ?? '' }}">
                        </div>
                    </div>
                </div>

                <!-- Before You Go Section -->
                <div class="card pb-2.5" id="section_before_you_go">
                    <div class="card-header flex justify-between items-center">
                        <h3 class="card-title">Before You Go</h3>
                        <label class="switch">
                            <input type="checkbox" name="enabled_pages[]" value="before-you-go"
                                {{ in_array('before-you-go', old('enabled_pages', $property->enabled_pages ?? [])) ? 'checked' : '' }}>
                            <span class="switch-label">Enabled</span>
                        </label>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="before_you_go_content">Before You Go</label>
                            <textarea id="before_you_go_content" name="before_you_go[content]" class="summernote">
                            {!! old('before_you_go.content', $property->beforeYouGo->content ?? '') !!}
                            </textarea>

                        </div>
                    </div>
                </div>

                <!-- Recommendations Section -->
                <div class="card pb-2.5" id="section_recommendations">
                    <div class="card-header">
                        <h3 class="card-title">Local Recommendations</h3>
                        <label class="switch">
                            <input type="checkbox" name="enabled_pages[]" value="recommendations"
                                {{ in_array('recommendations', old('enabled_pages', $property->enabled_pages ?? [])) ? 'checked' : '' }}>
                            <span class="switch-label">Enabled</span>
                        </label>
                    </div>
                    <div class="card-body grid gap-4">
                        @forelse ($recommendations as $rec)
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="recommendation_ids[]"
                                    value="{{ $rec->id }}"
                                    {{ in_array($rec->id, $selectedRecommendations) ? 'checked' : '' }}
                                >
                                <span>{{ $rec->title }} <small class="text-gray-500">({{ ucfirst($rec->category->name) }})</small></span>
                            </label>
                        @empty
                            <p class="text-sm text-gray-500">You haven’t created any recommendations yet.</p>
                        @endforelse
                    </div>
                </div>



                <!-- Settings Section -->
                <div class="card pb-2.5" id="section_settings">
                    <div class="card-header">
                        <h3 class="card-title">Appearance Settings</h3>
                    </div>
                    <div class="card-body grid gap-5">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">Primary Color</label>
                            <input type="color" name="settings[primary_color]" class="input w-20" value="{{ old('settings.primary_color', $property->settings->primary_color ?? '#000000') }}">
                        </div>

                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">Secondary Color</label>
                            <input type="color" name="settings[secondary_color]" class="input w-20" value="{{ old('settings.secondary_color', $property->settings->secondary_color ?? '#ffffff') }}">
                        </div>
                    </div>
                </div>



                <!-- Submit -->
                <div class="flex justify-end pt-2.5">
                    <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('rules-container');
    const addBtn = document.getElementById('add-rule-btn');
    let index = {{ count(old('rules', $property->rules ?? [])) }};

    addBtn.addEventListener('click', () => {
        const wrapper = document.createElement('div');
        wrapper.className = 'rule-group grid gap-2 p-4 border rounded-md bg-gray-50 relative';
        wrapper.innerHTML = `
            <button type="button" class="absolute  right-2 text-red-600 rounded-m remove-rule" title="Remove">&times;</button>
            <input type="text" name="rules[${index}][title]" placeholder="Title" class="input" />
            <textarea name="rules[${index}][description]" placeholder="Description" rows="2" class="input"></textarea>
        `;
        container.appendChild(wrapper);
        index++;
    });

    container.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-rule')) {
            e.target.closest('.rule-group').remove();
        }
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const faqContainer = document.getElementById('faqs-container');
    const addFaqBtn = document.getElementById('add-faq-btn');
    let faqIndex = {{ count(old('faqs', $property->faqs ?? [])) }};

    addFaqBtn?.addEventListener('click', () => {
        const wrapper = document.createElement('div');
        wrapper.className = 'faq-group grid gap-2 p-4 border rounded-md bg-gray-50 relative';
        wrapper.innerHTML = `
            <button type="button" class="absolute  right-2 text-red-600 rounded-m remove-faq" title="Remove">&times;</button>
            <input type="text" name="faqs[${faqIndex}][question]" class="input" placeholder="Question" />
            <textarea name="faqs[${faqIndex}][answer]" class="input" placeholder="Answer" rows="2"></textarea>
        `;
        faqContainer.appendChild(wrapper);
        faqIndex++;
    });

    faqContainer?.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-faq')) {
            e.target.closest('.faq-group').remove();
        }
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tContainer = document.getElementById('transportation-container');
    const tAddBtn = document.getElementById('add-transportation-btn');
    let tIndex = {{ count(old('transportation', $property->transportation ?? [])) }};

    tAddBtn?.addEventListener('click', () => {
        const wrapper = document.createElement('div');
        wrapper.className = 'transportation-group grid gap-2 p-4 border rounded-md bg-gray-50 relative';
        wrapper.innerHTML = `
            <button type="absolute  right-2 text-red-600 rounded-m remove-transportation" title="Remove">&times;</button>
            <input type="text" name="transportation[${tIndex}][title]" class="input" placeholder="Title" />
            <textarea name="transportation[${tIndex}][description]" class="input" placeholder="Description" rows="2"></textarea>
        `;
        tContainer.appendChild(wrapper);
        tIndex++;
    });

    tContainer?.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-transportation')) {
            e.target.closest('.transportation-group').remove();
        }
    });
});
</script>
@endpush
@isset($property)
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-image-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                if (!confirm('Are you sure you want to delete this image?')) return;

                const imageId = this.dataset.imageId;
                const propertyId = "{{ $property->id }}";
                const buttonEl = this;

                fetch(`/properties/${propertyId}/images/${imageId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                })
                .then(response => {
                    if (response.status === 200 || response.status === 204) {
                        buttonEl.closest('div.relative').remove();
                    } else {
                        return response.json().then(data => {
                            throw new Error(data.message || 'Failed to delete image.');
                        });
                    }
                })
                .catch((err) => {
                    alert(err.message || 'An error occurred.');
                });
            });
        });
    });
</script>
@endpush
@endisset



@push('scripts')
    <script>
$(document).ready(function () {
    // Store image tracking per editor instance
    const imageTrackers = new WeakMap();

    $('.summernote').each(function() {
        const $editor = $(this);
        const editorId = this.id || 'editor_' + Math.random().toString(36).substr(2, 9);

        // Initialize image tracker for this editor
        imageTrackers.set(this, {
            currentImages: new Set(),
            uploadedImages: new Map() // Map URL to image data (id, public_id)
        });

        $editor.summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onInit: function() {
                    console.log('Summernote initialized for:', editorId);

                    // Clean up any data URI images from previous sessions
                    const $editor = $(this);
                    const content = $editor.summernote('code');
                    const cleanedContent = content.replace(/<img[^>]*src="data:image\/[^"]*"[^>]*>/gi, '');

                    if (cleanedContent !== content) {
                        $editor.summernote('code', cleanedContent);
                    }

                    updateImageTracking(this);
                },

                onImageUpload: function(files) {
                    const editor = this;
                    for (let i = 0; i < files.length; i++) {
                        uploadImageToCloudinary(files[i], editor);
                    }
                },

                onChange: function(contents, $editable) {
                    // Debounce the deletion check
                    clearTimeout(this.deleteCheckTimeout);
                    this.deleteCheckTimeout = setTimeout(() => {
                        checkForDeletedImages(this);
                        updateImageTracking(this);
                    }, 500);
                },

                onKeydown: function(e) {
                    // Check if an image is selected when delete/backspace is pressed
                    if (e.keyCode === 8 || e.keyCode === 46) {
                        const selection = window.getSelection();
                        const selectedNode = selection.anchorNode;

                        if (selectedNode && selectedNode.nodeName === 'IMG') {
                            // Image will be deleted
                            setTimeout(() => {
                                checkForDeletedImages(this);
                                updateImageTracking(this);
                            }, 100);
                        }
                    }
                },

                onPaste: function(e) {
                    const clipboardData = e.originalEvent.clipboardData;
                    if (clipboardData && clipboardData.items) {
                        let hasImage = false;

                        for (const item of clipboardData.items) {
                            if (item.type.indexOf("image") !== -1) {
                                hasImage = true;
                                e.preventDefault();

                                const file = item.getAsFile();
                                if (file) {
                                    uploadImageToCloudinary(file, this);
                                }
                            }
                        }

                        if (hasImage) {
                            return false; // Prevent default paste behavior for images
                        }
                    }
                }
            }
        });
    });

    function getTracker(editor) {
        return imageTrackers.get(editor) || { currentImages: new Set(), uploadedImages: new Map() };
    }

    function updateImageTracking(editor) {
        const tracker = getTracker(editor);
        const newImages = new Set();
        const $content = $(editor).summernote('code');

        // Parse content and extract all image URLs
        const parser = new DOMParser();
        const doc = parser.parseFromString($content, 'text/html');
        const images = doc.querySelectorAll('img');

        images.forEach(img => {
            if (img.src) {
                newImages.add(img.src);
            }
        });

        tracker.currentImages = newImages;
    }

    function checkForDeletedImages(editor) {
        const tracker = getTracker(editor);
        const currentContent = $(editor).summernote('code');
        const currentImagesInEditor = new Set();

        // Extract all current image URLs
        const parser = new DOMParser();
        const doc = parser.parseFromString(currentContent, 'text/html');
        const images = doc.querySelectorAll('img');

        images.forEach(img => {
            if (img.src) {
                currentImagesInEditor.add(img.src);
            }
        });

        // Find deleted images
        tracker.currentImages.forEach(imageUrl => {
            if (!currentImagesInEditor.has(imageUrl)) {
                // Image was deleted
                const imageData = tracker.uploadedImages.get(imageUrl);
                if (imageData) {
                    handleImageDeletion(imageUrl, imageData);
                    tracker.uploadedImages.delete(imageUrl);
                }
            }
        });

        tracker.currentImages = currentImagesInEditor;
    }

    function handleImageDeletion(imageUrl, imageData) {
        console.log("Deleting image from Cloudinary:", imageUrl, imageData);

        // Show loading indicator (optional)
        const $status = $('<div class="alert alert-info">Deleting image from server...</div>');
        $('.summernote').first().before($status);

        $.ajax({
            url: '{{ route("editor.delete") }}',
            method: 'POST',
            data: {
                url: imageUrl,
                public_id: imageData.public_id,
                id: imageData.id
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log("Image successfully deleted:", response);
                $status.removeClass('alert-info').addClass('alert-success')
                       .text('Image deleted successfully').delay(2000).fadeOut();
            },
            error: function(xhr, status, error) {
                console.error("Failed to delete image:", error);
                $status.removeClass('alert-info').addClass('alert-danger')
                       .text('Failed to delete image from server').delay(3000).fadeOut();
            }
        });
    }

    function uploadImageToCloudinary(file, editor) {
        // Validate file
        const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!validTypes.includes(file.type)) {
            alert('Please upload only images (JPEG, PNG, GIF, WebP)');
            return;
        }

        // Check file size (4MB max)
        if (file.size > 4 * 1024 * 1024) {
            alert('Image size must be less than 4MB');
            return;
        }


        const data = new FormData();
        data.append("image", file);

        // Show loading placeholder
        const loadingUrl = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjUwIiB5PSI1MCIgc3R5bGU9ImZpbGw6I2FhYTtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxMnB4O2ZvbnQtZmFtaWx5OkFyaWFsLEhlbHZldGljYSxzYW5zLXNlcmlmO2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPlVwbG9hZGluZy4uLjwvdGV4dD48L3N2Zz4=';

        const $placeholder = $('<img>')
            .attr('src', loadingUrl)
            .attr('data-uploading', 'true')
            .css({ opacity: 0.5 });

        $(editor).summernote('insertNode', $placeholder[0]);

        $.ajax({
            url: '{{ route("editor.upload") }}',
            method: 'POST',
            data: data,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            xhr: function() {
                const xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        const percentComplete = evt.loaded / evt.total * 100;
                        console.log('Upload progress:', percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            success: function(response) {
                if (response.url) {
                    // Create a new image element with the actual URL
                    const $newImage = $('<img>')
                        .attr('src', response.url)
                        .attr('alt', file.name || 'Uploaded image')
                        .css({ maxWidth: '100%' });

                    // Replace the placeholder with the new image
                    $placeholder.replaceWith($newImage);

                    // Store image data for deletion tracking
                    const tracker = getTracker(editor);
                    tracker.uploadedImages.set(response.url, {
                        id: response.id,
                        public_id: response.public_id,
                        url: response.url
                    });

                    // Force Summernote to recognize the change
                    $(editor).summernote('code', $(editor).summernote('code'));

                    // Update tracking
                    setTimeout(() => updateImageTracking(editor), 100);
                } else {
                    $placeholder.remove();
                    alert('Upload failed: No URL returned');
                }
            },
            error: function(xhr, status, error) {
                $placeholder.remove();
                console.error("Upload error:", error);

                let errorMessage = 'Image upload failed';
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMessage = xhr.responseJSON.error;
                }
                alert(errorMessage);
            }
        });
    }

    // Optional: Clean up orphaned images when form is submitted
    $('form').on('submit', function() {
        // Link all uploaded images to the content being saved
        const allUploadedImages = [];

        $('.summernote').each(function() {
            const tracker = getTracker(this);
            tracker.uploadedImages.forEach((imageData, url) => {
                if (tracker.currentImages.has(url)) {
                    allUploadedImages.push(imageData.id);
                }
            });
        });

        if (allUploadedImages.length > 0) {
            // Add hidden input with image IDs to link them
            $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'editor_image_ids')
                .attr('value', JSON.stringify(allUploadedImages))
                .appendTo(this);
        }
    });
});
    </script>
@endpush

