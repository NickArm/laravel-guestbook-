<form method="POST" action="{{ $action }}">
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
                                <input class="input" type="text" name="{{ $name }}" value="{{ old($name, $property->$name ?? '') }}">
                            </div>
                        @endforeach

                        @foreach([
                            ['welcome_message', 'Welcome Message'],
                        ] as [$name, $label])
                            @php
                                $value = old($name, $property->$name ?? '');
                            @endphp
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-56">{{ $label }}</label>
                                <div class="grow">
                                    <input id="{{ $name }}" type="hidden" name="{{ $name }}" value="{{ $value }}">
                                    <trix-editor input="{{ $name }}"></trix-editor>
                                </div>
                            </div>
                        @endforeach

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
                                    <input id="{{ $name }}" type="hidden" name="{{ $name }}" value="{{ $value }}">
                                    <trix-editor input="{{ $name }}"></trix-editor>
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
                            $wifi = old('wifi', $property->wifi ?? []);
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
                            <div class="grow">
                                <input id="wifi_description" type="hidden" name="wifi[description]" value="{{ $wifiDescription }}">
                                <trix-editor input="wifi_description"></trix-editor>
                            </div>
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
                                <input class="input" type="text" name="{{ $name }}" value="{{ old($name, $property->$name ?? '') }}">
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
                                    <input id="{{ $name }}" type="hidden" name="{{ $name }}" value="{{ $value }}">
                                    <trix-editor input="{{ $name }}"></trix-editor>
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
                                <input class="input" type="text" name="{{ $name }}" value="{{ old($name, $property->$name ?? '') }}">
                            </div>
                        @endforeach

                        @php $name = 'location_description'; $label = 'Location Description'; @endphp
                       @php
                            $value = old($name, $property->$name ?? '');
                        @endphp
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">{{ $label }}</label>
                            <div class="grow">
                                <input id="{{ $name }}" type="hidden" name="{{ $name }}" value="{{ $value }}">
                                <trix-editor input="{{ $name }}"></trix-editor>
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
                            @foreach(old('transportation', $property->transportation->toArray() ?? []) as $index => $t)
                                <div class="transportation-group grid gap-2 p-4 border rounded-md bg-gray-50 relative">
                                    <button type="button" class="absolute top-2 right-2 text-red-600 remove-transportation" title="Remove">&times;</button>
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
                            @foreach(old('rules', $property->rules->toArray() ?? []) as $index => $rule)
                                <div class="rule-group grid gap-2 p-4 border rounded-md bg-gray-50 relative">
                                    <button type="button" class="absolute top-2 right-2 text-red-600 remove-rule" title="Remove">&times;</button>
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
                            @foreach(old('faqs', $property->faqs->toArray() ?? []) as $index => $faq)
                                <div class="faq-group grid gap-2 p-4 border rounded-md bg-gray-50 relative">
                                    <button type="button" class="absolute top-2 right-2 text-red-600 remove-faq" title="Remove">&times;</button>
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
            <button type="button" class="absolute top-2 right-2 text-red-600 remove-rule" title="Remove">&times;</button>
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
            <button type="button" class="absolute top-2 right-2 text-red-600 remove-faq" title="Remove">&times;</button>
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
            <button type="button" class="absolute top-2 right-2 text-red-600 remove-transportation" title="Remove">&times;</button>
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
