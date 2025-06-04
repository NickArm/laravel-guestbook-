@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Manage Users</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">+ Create User</a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($users->isEmpty())
        <p>No users found.</p>
    @else
        <div class="overflow-x-auto rounded shadow border border-gray-200">
            <table class="min-w-full bg-white text-sm">
                <thead class="bg-gray-100 text-left font-semibold">
                    <tr>
                        <th class="px-4 py-3 border-b">Name</th>
                        <th class="px-4 py-3 border-b">Email</th>
                        <th class="px-4 py-3 border-b">Role</th>
                        <th class="px-4 py-3 border-b">Status</th>
                        <th class="px-4 py-3 border-b text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b">{{ $user->name }}</td>
                            <td class="px-4 py-2 border-b">{{ $user->email }}</td>
                            <td class="px-4 py-2 border-b">{{ $user->getRoleNames()->join(', ') }}</td>
                            <td class="px-4 py-2 border-b">
                                @if ($user->is_active)
                                    <span class="text-green-600 font-semibold">Active</span>
                                @else
                                    <span class="text-red-600 font-semibold">Inactive</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border-b text-right space-x-2">
                                <a href="{{ route('admin.users.edit', $user) }}"
                                   class="inline-block px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-xs">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('admin.users.toggle', $user) }}" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="px-3 py-1 text-xs rounded text-white {{ $user->is_active ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }}">
                                        {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
