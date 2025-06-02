<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Cloudinary\Cloudinary;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Optional fields
        $user->bio = $request->input('bio');
        $user->address = $request->input('address');
        $user->mobile_number = $request->input('mobile_number');
        $user->contact_me = $request->input('contact_me', []);

        // Photo Upload
        if ($request->hasFile('photo')) {

            $cloudinary = app(Cloudinary::class);
            try {
                $upload = $cloudinary->uploadApi()->upload(
                    $request->file('photo')->getRealPath(),
                    [
                        'folder' => 'users/'.$user->id,
                        'public_id' => 'profile',
                        'overwrite' => true,
                    ]
                );

                $user->photo = $upload['secure_url'];
            } catch (\Exception $e) {
                return back()->withErrors(['photo' => 'Failed to upload profile photo.']);
            }
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('status', 'password-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
