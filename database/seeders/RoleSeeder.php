<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Super Admin',
                'slug' => 'super-admin',
                'description' => 'Full access to all system features including user management',
            ],
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Full access to all system features except user management',
            ],
            [
                'name' => 'Accountant',
                'slug' => 'accountant',
                'description' => 'Access to reservations, bookings, expenses, and sales reports',
            ],
            [
                'name' => 'Front Office',
                'slug' => 'front-office',
                'description' => 'Access to room management, check-in/out, reservations, and sales reports',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['slug' => $role['slug']],
                $role
            );
        }
    }
}
