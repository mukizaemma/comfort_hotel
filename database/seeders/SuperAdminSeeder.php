<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::where('slug', 'super-admin')->first();

        if ($superAdminRole) {
            User::updateOrCreate(
                ['email' => 'superadmin@comforthotel.com'],
                [
                    'name' => 'Super Admin',
                    'user_id' => Uuid::uuid4(),
                    'email' => 'superadmin@comforthotel.com',
                    'password' => Hash::make('password'),
                    'role_id' => $superAdminRole->id,
                    'status' => 'Active',
                ]
            );
        }
    }
}
