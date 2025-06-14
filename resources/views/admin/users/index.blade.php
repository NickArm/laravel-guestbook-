@extends('layouts.app')

@section('header')
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">User Management</h1>
            <nav class="flex mt-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="#" class="text-gray-500 hover:text-gray-700">Admin</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-500 ml-1 md:ml-2">Users</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                <i class="ki-duotone ki-plus text-lg mr-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                Add User
            </a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors">
                    <i class="ki-duotone ki-entrance-left text-lg mr-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Logout
                </button>
            </form>
        </div>
    </div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-2 lg:px-8 py-8">

    @if (session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="ki-duotone ki-shield-tick text-green-400 text-2xl">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <div class="ml-3">
                    <h4 class="text-sm font-medium text-green-800">Success!</h4>
                    <p class="text-sm text-green-700 mt-1">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Users Card -->
    <div class="bg-white shadow-sm rounded-lg border border-gray-200 mb-8">
        <!-- Card Header -->
        <div class="border-b border-gray-200 px-2 py-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ki-duotone ki-magnifier text-gray-400">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                        <input type="text"
                               data-kt-user-table-filter="search"
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Search users...">
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="relative inline-block text-left">
                        <button type="button"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                data-toggle="dropdown">
                            <i class="ki-duotone ki-filter mr-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Filter
                            <i class="ki-duotone ki-down ml-2">
                                <span class="path1"></span>
                            </i>
                        </button>
                        <div class="origin-top-right absolute right-0 mt-2 w-80 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden" data-dropdown-menu>
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Filter Options</h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Status:</label>
                                        <select class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" data-kt-user-table-filter="status">
                                            <option value="">All Status</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="flex justify-end space-x-3 pt-4">
                                        <button type="button"
                                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg"
                                                data-kt-user-table-filter="reset">
                                            Reset
                                        </button>
                                        <button type="button"
                                                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg"
                                                data-kt-user-table-filter="filter">
                                            Apply
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="p-6">
            @if ($users->isEmpty())
                <div class="text-center py-16">
                    <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                        <i class="ki-duotone ki-users text-gray-400 text-4xl">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No users found</h3>
                    <p class="text-gray-500 mb-6">Start by adding your first user to get started.</p>
                    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg">
                        Add User
                    </a>
                </div>
            @else
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="kt_table_users">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-2 py-3 text-left">
                                    <div class="flex items-center">
                                        <input type="checkbox"
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                               data-kt-check="true"
                                               data-kt-check-target="#kt_table_users input[type='checkbox']:not([data-kt-check])">
                                    </div>
                                </th>
                                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Updated</th>
                                <th class="px-2 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-2 py-4">
                                        <input type="checkbox"
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                               value="{{ $user->id }}">
                                    </td>
                                    <td class="px-2 py-4">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <a href="{{ route('admin.users.edit', $user) }}" class="hover:text-blue-600">
                                                        {{ $user->name }}
                                                    </a>
                                                </div>
                                                <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-2 py-4">
                                        @forelse($user->getRoleNames() as $role)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mb-1">
                                                {{ $role }}
                                            </span>
                                        @empty
                                            <span class="text-sm text-gray-500">No role assigned</span>
                                        @endforelse
                                    </td>
                                    <td class="px-2 py-4">
                                        @if ($user->is_active)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <span class="w-2 h-2 bg-green-400 rounded-full mr-1.5"></span>
                                                Active
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <span class="w-2 h-2 bg-red-400 rounded-full mr-1.5"></span>
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-2 py-4 text-sm text-gray-900">
                                        <div>{{ $user->updated_at->format('M d, Y') }}</div>
                                        <div class="text-xs text-gray-500">{{ $user->updated_at->format('h:i A') }}</div>
                                    </td>
                                    <td class="px-2 py-4 text-right">
                                        <div class="relative inline-block text-left">
                                            <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                    data-toggle="dropdown">
                                                Actions
                                                <i class="ki-duotone ki-down ml-1">
                                                    <span class="path1"></span>
                                                </i>
                                            </button>
                                            <div class="origin-top-right absolute right-0 mt-2 w-40 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-10" data-dropdown-menu>
                                                <div class="py-1">
                                                    <a href="{{ route('admin.users.edit', $user) }}"
                                                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                        <i class="ki-duotone ki-pencil mr-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        Edit
                                                    </a>
                                                    <form method="POST" action="{{ route('admin.users.toggle', $user) }}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                            @if($user->is_active)
                                                                <i class="ki-duotone ki-toggle-off mr-2">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                </i>
                                                                Deactivate
                                                            @else
                                                                <i class="ki-duotone ki-toggle-on mr-2">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                </i>
                                                                Activate
                                                            @endif
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    @if ($activities->isNotEmpty())
        <!-- Activity Log Card -->
        <div class="bg-white shadow-sm rounded-lg border border-gray-200">
            <!-- Card Header -->
            <div class="border-b border-gray-200 px-2 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="ki-duotone ki-abstract-39 text-blue-600 text-2xl mr-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <h3 class="text-lg font-semibold text-gray-900">Recent Activity Logs</h3>
                    </div>
                    <div class="relative inline-block text-left">
                        <button type="button"
                                class="p-2 text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-lg"
                                data-toggle="dropdown">
                            <i class="ki-duotone ki-category">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </button>
                        <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden" data-dropdown-menu>
                            <div class="py-1">
                                <div class="px-4 py-2 text-xs font-medium text-gray-500 uppercase tracking-wide">Options</div>
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="ki-duotone ki-file-down mr-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Export Logs
                                </a>
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <i class="ki-duotone ki-trash mr-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                    Clear Old Logs
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Target Model</th>
                                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Changes</th>
                                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($activities as $log)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-2 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if($log->causer && $log->causer->photo)
                                                    <img class="h-10 w-10 rounded-full object-cover"
                                                         src="{{ Storage::url($log->causer->photo) }}"
                                                         alt="{{ $log->causer->name }}">
                                                @else
                                                    <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center">
                                                        <span class="text-sm font-medium text-gray-600">
                                                            {{ $log->causer ? strtoupper(substr($log->causer->name, 0, 1)) : 'S' }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $log->causer?->name ?? 'System' }}
                                                </div>
                                                @if($log->causer)
                                                    <div class="text-sm text-gray-500">{{ $log->causer->email }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-2 py-4">
                                        @php
                                            $actionClasses = match($log->description) {
                                                'created' => 'bg-green-100 text-green-800',
                                                'updated' => 'bg-blue-100 text-blue-800',
                                                'deleted' => 'bg-red-100 text-red-800',
                                                default => 'bg-gray-100 text-gray-800'
                                            };
                                            $actionIcon = match($log->description) {
                                                'created' => 'ki-plus',
                                                'updated' => 'ki-pencil',
                                                'deleted' => 'ki-trash',
                                                default => 'ki-information'
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $actionClasses }}">
                                            <i class="ki-duotone {{ $actionIcon }} mr-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            {{ ucfirst($log->description) }}
                                        </span>
                                    </td>
                                    <td class="px-2 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ class_basename($log->subject_type) }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($log->subject_id, 12, '...') }}</div>
                                    </td>
                                    <td class="px-2 py-4">
                                        @if($log->properties && isset($log->properties['attributes']))
                                            @php
                                                $changes = collect($log->properties['attributes'])->take(3);
                                                $totalChanges = count($log->properties['attributes']);
                                            @endphp
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($changes as $key => $value)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        {{ ucfirst(str_replace('_', ' ', $key)) }}
                                                    </span>
                                                @endforeach
                                                @if($totalChanges > 3)
                                                    <span class="text-xs text-gray-500">+{{ $totalChanges - 3 }} more</span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-sm text-gray-500">No specific changes recorded</span>
                                        @endif
                                    </td>
                                    <td class="px-2 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $log->created_at->format('M d, Y') }}</div>
                                        <div class="text-sm text-gray-500">{{ $log->created_at->format('h:i:s A') }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dropdown functionality
    document.querySelectorAll('[data-toggle="dropdown"]').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            const dropdown = this.parentNode.querySelector('[data-dropdown-menu]');

            // Close all other dropdowns
            document.querySelectorAll('[data-dropdown-menu]').forEach(menu => {
                if (menu !== dropdown) {
                    menu.classList.add('hidden');
                }
            });

            // Toggle current dropdown
            dropdown.classList.toggle('hidden');
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function() {
        document.querySelectorAll('[data-dropdown-menu]').forEach(menu => {
            menu.classList.add('hidden');
        });
    });

    // Search functionality
    const searchInput = document.querySelector('[data-kt-user-table-filter="search"]');
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            const filterValue = e.target.value.toLowerCase();
            const tableRows = document.querySelectorAll('#kt_table_users tbody tr');

            tableRows.forEach(row => {
                const nameCell = row.querySelector('td:nth-child(2)');
                if (nameCell) {
                    const text = nameCell.textContent.toLowerCase();
                    row.style.display = text.includes(filterValue) ? '' : 'none';
                }
            });
        });
    }

    // Master checkbox functionality
    const masterCheckbox = document.querySelector('[data-kt-check="true"]');
    if (masterCheckbox) {
        masterCheckbox.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('#kt_table_users input[type="checkbox"]:not([data-kt-check])');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    }

    // Filter functionality
    const statusFilter = document.querySelector('[data-kt-user-table-filter="status"]');
    const filterBtn = document.querySelector('[data-kt-user-table-filter="filter"]');
    const resetBtn = document.querySelector('[data-kt-user-table-filter="reset"]');

    if (filterBtn) {
        filterBtn.addEventListener('click', function() {
            const statusValue = statusFilter ? statusFilter.value.toLowerCase() : '';
            const tableRows = document.querySelectorAll('#kt_table_users tbody tr');

            tableRows.forEach(row => {
                const statusCell = row.querySelector('td:nth-child(4)');
                if (statusCell && statusValue) {
                    const statusText = statusCell.textContent.toLowerCase();
                    row.style.display = statusText.includes(statusValue) ? '' : 'none';
                } else {
                    row.style.display = '';
                }
            });

            // Close dropdown
            document.querySelectorAll('[data-dropdown-menu]').forEach(menu => {
                menu.classList.add('hidden');
            });
        });
    }

    if (resetBtn) {
        resetBtn.addEventListener('click', function() {
            const tableRows = document.querySelectorAll('#kt_table_users tbody tr');
            tableRows.forEach(row => {
                row.style.display = '';
            });
            if (statusFilter) statusFilter.value = '';
            if (searchInput) searchInput.value = '';

            // Close dropdown
            document.querySelectorAll('[data-dropdown-menu]').forEach(menu => {
                menu.classList.add('hidden');
            });
        });
    }
});
</script>
@endpush
