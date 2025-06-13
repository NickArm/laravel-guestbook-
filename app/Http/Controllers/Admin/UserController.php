<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\UserActivated;
use App\Mail\UserDeactivated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $activities = Activity::latest()->take(20)->get(); // ή βάλε ->whereNotNull('causer_id') αν θες μόνο με χρήστη

        return view('admin.users.index', compact('users', 'activities'));
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

        $wasInactive = ! $user->is_active;
        $isActiveNow = $request->has('is_active');

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'property_limit' => $request->property_limit,
            'is_active' => $isActiveNow,
        ]);

        $user->syncRoles([$request->role]);

        if ($wasInactive && $isActiveNow) {
            Mail::to($user->email)->send(new UserActivated($user));
        } elseif (! $isActiveNow && $user->is_active) {
            Mail::to($user->email)->send(new UserDeactivated($user));
        }

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
