<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">
            Create New Property
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-8">
        <form method="POST" action="{{ route('properties.store') }}" class="space-y-6">
            @csrf

            <div>
                <label class="block font-medium">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-medium">Slug</label>
                <input type="text" name="slug" value="{{ old('slug') }}" required class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-medium">Address</label>
                <input type="text" name="address" value="{{ old('address') }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-medium">Check-in</label>
                <input type="text" name="checkin" value="{{ old('checkin') }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-medium">Check-in Instructions</label>
                <textarea name="checkin_instructions" rows="3" class="w-full border p-2 rounded">{{ old('checkin_instructions') }}</textarea>
            </div>

            <div>
                <label class="block font-medium">Check-out</label>
                <input type="text" name="checkout" value="{{ old('checkout') }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-medium">Check-out Instructions</label>
                <textarea name="checkout_instructions" rows="3" class="w-full border p-2 rounded">{{ old('checkout_instructions') }}</textarea>
            </div>

            <div>
                <label class="block font-medium">Welcome Title</label>
                <input type="text" name="welcome_title" value="{{ old('welcome_title') }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-medium">Welcome Message</label>
                <textarea name="welcome_message" rows="6" class="w-full border p-2 rounded">{{ old('welcome_message') }}</textarea>
            </div>

            <div>
                <label class="block font-medium">Amenities Description</label>
                <textarea name="amenities_description" rows="6" class="w-full border p-2 rounded">{{ old('amenities_description') }}</textarea>
            </div>

            <div>
                <label class="block font-medium">Location Area</label>
                <input type="text" name="location_area" value="{{ old('location_area') }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-medium">Location Country</label>
                <input type="text" name="location_country" value="{{ old('location_country') }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-medium">Google Map URL</label>
                <input type="text" name="google_map_url" value="{{ old('google_map_url') }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block font-medium">Location Description</label>
                <textarea name="location_description" rows="4" class="w-full border p-2 rounded">{{ old('location_description') }}</textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Create Property
            </button>
        </form>
    </div>
</x-app-layout>
