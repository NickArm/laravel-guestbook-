<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:user,superadmin',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => $request->has('is_active'),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'property_limit' => ['nullable', 'integer', 'min:0'],
            'role' => ['required', Rule::in(['user', 'superadmin'])],
            'is_active' => ['nullable'],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'property_limit' => $request->property_limit,
            'is_active' => $request->has('is_active'),
        ]);

        // Sync role
        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users.index')->with('success', 'User updated!');
    }

    public function toggleStatus(User $user)
    {
        if ($user->hasRole('superadmin')) {
            return back()->with('error', 'You cannot deactivate a Superadmin.');
        }

        $user->is_active = ! $user->is_active;
        $user->save();

        return back()->with('success', 'User status updated.');
    }
}
