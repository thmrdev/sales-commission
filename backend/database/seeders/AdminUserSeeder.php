<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sc.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('scpass'),
                'is_admin' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@sc.com'],
            [
                'name' => 'User',
                'password' => Hash::make('scpass'),
            ]
        );
    }
}
