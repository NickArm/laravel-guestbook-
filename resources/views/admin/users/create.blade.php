<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create User
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="/admin/users" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block font-medium">Name</label>
                        <input type="text" name="name" required class="w-full border p-2 rounded">
                    </div>

                    <div>
                        <label class="block font-medium">Email</label>
                        <input type="email" name="email" required class="w-full border p-2 rounded">
                    </div>

                    <div>
                        <label class="block font-medium">Password</label>
                        <input type="password" name="password" required class="w-full border p-2 rounded">
                    </div>

                    <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Create User
                    </button>
                </form>
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-4 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
