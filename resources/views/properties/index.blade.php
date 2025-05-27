<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">My Properties</h2>
    </x-slot>

    @if (session('success'))
        <div class="bg-green-100 p-2 rounded my-2">{{ session('success') }}</div>
    @endif

    <a href="{{ route('properties.create') }}" class="btn btn-primary">+ Add Property</a>

    <table class="w-full mt-4 border">
        <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($properties as $property)
                <tr>
                    <td>{{ $property->name }}</td>
                    <td>{{ $property->slug }}</td>
                    <td>{{ $property->is_active ? 'Active' : 'Inactive' }}</td>
                    <td class="space-x-2">
                        <a href="{{ route('properties.edit', $property) }}" class="text-blue-500">Edit</a>

                        <form action="{{ route('properties.toggle', $property) }}" method="POST" class="inline">
                            @csrf @method('PATCH')
                            <button class="text-yellow-500">{{ $property->is_active ? 'Deactivate' : 'Activate' }}</button>
                        </form>

                        <form action="{{ route('properties.destroy', $property) }}" method="POST" class="inline" onsubmit="return confirm('Delete property?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
