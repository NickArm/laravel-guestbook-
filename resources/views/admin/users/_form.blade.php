<form method="POST" action="{{ $action }}">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div class="mb-4">
        <label class="block font-medium mb-1">Name</label>
        <input type="text" name="name" class="input w-full" value="{{ old('name', $user->name ?? '') }}" required>
    </div>

    <div class="mb-4">
        <label class="block font-medium mb-1">Email</label>
        <input type="email" name="email" class="input w-full" value="{{ old('email', $user->email ?? '') }}" required>
    </div>

    @if ($method === 'POST')
    <div class="mb-4">
        <label class="block font-medium mb-1">Password</label>
        <input type="password" name="password" class="input w-full" required>
    </div>
    @endif

    <div class="mb-4">
        <label class="block font-medium mb-1">Property Limit</label>
        <input type="number" name="property_limit" class="input w-full"
            value="{{ old('property_limit', $user->property_limit ?? 0) }}" min="0">
    </div>

    <div class="mb-4">
        <label class="block font-medium mb-1">Role</label>
        <select name="role" class="input w-full" required>
            <option value="user" {{ (old('role', $user->getRoleNames()->first() ?? '') === 'user') ? 'selected' : '' }}>User</option>
            <option value="superadmin" {{ (old('role', $user->getRoleNames()->first() ?? '') === 'superadmin') ? 'selected' : '' }}>Superadmin</option>
        </select>
    </div>

    <div class="mb-6">
        <label class="inline-flex items-center">
            <input type="checkbox" name="is_active" class="mr-2"
                {{ old('is_active', $user->is_active ?? false) ? 'checked' : '' }}>
            <span>Active</span>
        </label>
    </div>

    <button type="submit" class="btn btn-primary">{{ $button }}</button>
</form>
