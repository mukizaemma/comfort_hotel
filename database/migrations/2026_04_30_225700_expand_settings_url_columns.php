<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE settings MODIFY linktree TEXT NULL");
        DB::statement("ALTER TABLE settings MODIFY google_reviews_url TEXT NULL");
        DB::statement("ALTER TABLE settings MODIFY tripadvisor_reviews_url TEXT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE settings MODIFY linktree VARCHAR(255) NULL");
        DB::statement("ALTER TABLE settings MODIFY google_reviews_url VARCHAR(255) NULL");
        DB::statement("ALTER TABLE settings MODIFY tripadvisor_reviews_url VARCHAR(255) NULL");
    }
};
