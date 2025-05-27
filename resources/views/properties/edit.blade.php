<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">
            Edit Property: {{ $property->name }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-8">
        <form method="POST" action="{{ route('properties.update', $property) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium">Name</label>
                <input type="text" name="name" value="{{ old('name', $property->name) }}" required class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-medium">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $property->slug) }}" required class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-medium">Address</label>
                <input type="text" name="address" value="{{ old('address', $property->address) }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-medium">Check-in</label>
                <input type="text" name="checkin" value="{{ old('checkin', $property->checkin) }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-medium">Check-in Instructions</label>
                <textarea name="checkin_instructions" rows="3" class="w-full border p-2 rounded">{{ old('checkin_instructions', $property->checkin_instructions) }}</textarea>
            </div>

            <div>
                <label class="block font-medium">Check-out</label>
                <input type="text" name="checkout" value="{{ old('checkout', $property->checkout) }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-medium">Check-out Instructions</label>
                <textarea name="checkout_instructions" rows="3" class="w-full border p-2 rounded">{{ old('checkout_instructions', $property->checkout_instructions) }}</textarea>
            </div>

            <div>
                <label class="block font-medium">Welcome Title</label>
                <input type="text" name="welcome_title" value="{{ old('welcome_title', $property->welcome_title) }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-medium">Welcome Message</label>
                <textarea name="welcome_message" rows="6" class="w-full border p-2 rounded">{{ old('welcome_message', $property->welcome_message) }}</textarea>
            </div>

            <div>
                <label class="block font-medium">Amenities Description</label>
                <textarea name="amenities_description" rows="6" class="w-full border p-2 rounded">{{ old('amenities_description', $property->amenities_description) }}</textarea>
            </div>

            <div>
                <label class="block font-medium">Location Area</label>
                <input type="text" name="location_area" value="{{ old('location_area', $property->location_area) }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-medium">Location Country</label>
                <input type="text" name="location_country" value="{{ old('location_country', $property->location_country) }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-medium">Google Map URL</label>
                <input type="text" name="google_map_url" value="{{ old('google_map_url', $property->google_map_url) }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-medium">Location Description</label>
                <textarea name="location_description" rows="4" class="w-full border p-2 rounded">{{ old('location_description', $property->location_description) }}</textarea>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Update Property
            </button>

            <div class="mt-10">
            <h3 class="text-lg font-semibold mb-4">Rules</h3>

            <div id="rules-wrapper">
                @foreach(old('rules', $property->rules ?? []) as $i => $rule)
                    <div class="mb-4 border p-4 rounded bg-gray-50">
                        <div class="mb-2">
                            <label class="block font-medium">Title</label>
                            <input type="text" name="rules[{{ $i }}][title]" value="{{ old("rules.$i.title", $rule['title'] ?? '') }}" class="w-full border p-2 rounded" required>
                        </div>
                        <div>
                            <label class="block font-medium">Description</label>
                            <textarea name="rules[{{ $i }}][description]" class="w-full border p-2 rounded" required>{{ old("rules.$i.description", $rule['description'] ?? '') }}</textarea>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="button" onclick="addRule()" class="mt-2 px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">+ Add Rule</button>
        </div>

        </form>
    </div>
</x-app-layout>
<script>
    let ruleIndex = {{ count(old('rules', $property->rules ?? [])) }};

    function addRule() {
        const wrapper = document.getElementById('rules-wrapper');
        const div = document.createElement('div');
        div.classList.add('mb-4', 'border', 'p-4', 'rounded', 'bg-gray-50');
        div.innerHTML = `
            <div class="mb-2">
                <label class="block font-medium">Title</label>
                <input type="text" name="rules[${ruleIndex}][title]" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label class="block font-medium">Description</label>
                <textarea name="rules[${ruleIndex}][description]" class="w-full border p-2 rounded" required></textarea>
            </div>
        `;
        wrapper.appendChild(div);
        ruleIndex++;
    }
</script>
