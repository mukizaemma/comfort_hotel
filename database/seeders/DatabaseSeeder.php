<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,           // Creates 4 roles (Super Admin, Admin, Accountant, Front Office)
            SuperAdminSeeder::class,      // Creates super admin user
            CountrySeeder::class,         // Seeds common countries (optional - for user profiles)
            AmenitySeeder::class,         // Seeds 150+ hotel amenities
            HotelSettingSeeder::class,    // Creates default hotel settings
        ]);
    }
}
