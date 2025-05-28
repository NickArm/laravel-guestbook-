<form method="POST" action="{{ $action }}" class="grid gap-5">
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <!-- Left Column (Property Fields) -->
        <div class="lg:col-span-2">
            <div class="card h-full">
                <div class="card-body">
                    <div class="grid gap-5">
                        @foreach([
                            ['name', 'Name'],
                            ['slug', 'Slug'],
                            ['address', 'Address'],
                            ['checkin', 'Check-in'],
                            ['checkout', 'Check-out'],
                            ['welcome_title', 'Welcome Title'],
                            ['location_area', 'Location Area'],
                            ['location_country', 'Location Country'],
                            ['google_map_url', 'Google Map URL'],
                        ] as [$name, $label])
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-56">{{ $label }}</label>
                                <input class="input" type="text" name="{{ $name }}" value="{{ old($name, $property->$name ?? '') }}">
                            </div>
                        @endforeach

                        @foreach([
                            ['checkin_instructions', 'Check-in Instructions'],
                            ['checkout_instructions', 'Check-out Instructions'],
                            ['welcome_message', 'Welcome Message'],
                            ['amenities_description', 'Amenities Description'],
                            ['location_description', 'Location Description'],
                        ] as [$name, $label])
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-56">{{ $label }}</label>
                                <textarea class="input" name="{{ $name }}" rows="3">{{ old($name, $property->$name ?? '') }}</textarea>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column (Rules) -->
        <div class="lg:col-span-1">
            <div class="card h-full">
                <div class="card-body">
                    <h4 class="text-lg font-semibold mb-4">Rules</h4>
                        <div id="rules-container" class="grid gap-4">
                            @foreach(old('rules', $property->rules->toArray() ?? []) as $index => $rule)
                                <div class="rule-group grid gap-2 p-4 border rounded-md bg-gray-50 relative">
                                    <button type="button" class="absolute top-2 right-2 text-red-600 remove-rule" title="Remove">
                                        &times;
                                    </button>

                                    <input type="text" name="rules[{{ $index }}][title]" placeholder="Title"
                                        class="input" value="{{ $rule['title'] ?? '' }}">

                                    <textarea name="rules[{{ $index }}][description]" placeholder="Description"
                                        class="input" rows="2">{{ $rule['description'] ?? '' }}</textarea>
                                </div>
                            @endforeach
                        </div>
                    <button type="button" id="add-rule-btn" class="btn btn-sm btn-light mt-4">
                        + Add Rule
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit -->
    <div class="flex justify-end mt-6">
        <button type="submit" class="btn btn-primary">
            {{ $submitLabel }}
        </button>
    </div>
</form>

<!-- JavaScript για dynamic rules -->
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

// 🧹 Remove rule on button click
container.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-rule')) {
        e.target.closest('.rule-group').remove();
    }
});
});
</script>
@endpush
