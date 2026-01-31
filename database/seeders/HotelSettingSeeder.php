<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class HotelSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if settings table exists and is empty
        if (!Schema::hasTable('settings')) {
            return;
        }

        // Only seed if settings table is empty
        if (DB::table('settings')->count() > 0) {
            return;
        }

        $superAdmin = User::where('email', 'superadmin@comforthotel.com')->first();

        DB::table('settings')->insert([
            'title' => 'Comfort Hotel',
            'company' => 'Comfort Hotel',
            'address' => 'Kigali, Rwanda',
            'phone' => '+250 788 123 456',
            'email' => 'info@comforthotel.com',
            'facebook' => 'https://facebook.com/comforthotel',
            'instagram' => 'https://instagram.com/comforthotel',
            'twitter' => 'https://twitter.com/comforthotel',
            'youtube' => 'https://youtube.com/comforthotel',
            'linkedin' => 'https://linkedin.com/company/comforthotel',
            'linktree' => null,
            'donate' => null,
            'logo' => null,
            'user_id' => $superAdmin ? $superAdmin->id : 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
