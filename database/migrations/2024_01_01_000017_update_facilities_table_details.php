<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('facilities')) {
            return;
        }

        Schema::table('facilities', function (Blueprint $table) {
            if (!Schema::hasColumn('facilities', 'cover_image')) {
                $table->string('cover_image')->nullable()->after('image');
            }
            // Slug and description already exist, ensure they're correct
            if (!Schema::hasColumn('facilities', 'slug')) {
                $table->string('slug')->unique()->after('title');
            }
            if (Schema::hasColumn('facilities', 'description')) {
                $table->longText('description')->nullable()->change();
            } else {
                $table->longText('description')->nullable()->after('slug');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->dropColumn(['cover_image']);
        });
    }
};
