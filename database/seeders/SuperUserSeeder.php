<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@luminafinances.com',
            'password' => Hash::make('password@sco'),
            'plan' => 'business',
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);
    }
}
