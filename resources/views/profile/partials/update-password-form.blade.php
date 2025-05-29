
    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5 mb-5">
            <label class="form-label max-w-56">Current Password</label>
            <input type="password" name="current_password" class="input" placeholder="Your current password" autocomplete="current-password">
        </div>

        <!-- New Password -->
        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5 mb-5">
            <label class="form-label max-w-56">New Password</label>
            <input type="password" name="password" class="input" placeholder="New password" autocomplete="new-password">
        </div>

        <!-- Confirm New Password -->
        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5 mb-2.5 mb-5">
            <label class="form-label max-w-56">Confirm New Password</label>
            <input type="password" name="password_confirmation" class="input" placeholder="Confirm new password" autocomplete="new-password">
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button class="btn btn-primary" type="submit">Reset Password</button>
        </div>

        @if (session('status') === 'password-updated')
            <p class="text-sm text-success mt-3">Password updated successfully.</p>
        @endif
    </form>

