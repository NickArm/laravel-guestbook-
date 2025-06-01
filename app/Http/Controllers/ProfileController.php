<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Standard validated fields
        $user->fill($request->validated());

        // Αν το email άλλαξε, μηδενίζουμε την επιβεβαίωση
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Συμπληρωματικά πεδία (εκτός validated αν δεν μπήκαν στο request class)
        $user->bio = $request->input('bio');
        $user->address = $request->input('address');
        $user->mobile_number = $request->input('mobile_number');

        if ($request->hasFile('photo')) {
            $upload = Cloudinary::upload($request->file('photo')->getRealPath(), [
                'folder' => 'users/'.$user->id,
                'public_id' => 'profile',
                'overwrite' => true,
            ]);

            $user->update(['photo' => $upload->getSecurePath()]);
        }

        // Contacts ως JSON
        $user->contact_me = $request->input('contact_me', []);

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
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

    public function updatePassword(Request $request)
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
}
