<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = User::firstOrCreate([
            'email' => 'admin@guesthouse.com',
        ], [
            'name' => 'Superadmin',
            'password' => Hash::make('password'),
            'is_active' => true,
        ]);

        $user->assignRole('superadmin');
    }
}
