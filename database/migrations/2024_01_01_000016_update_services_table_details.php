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
        if (!Schema::hasTable('services')) {
            return;
        }

        Schema::table('services', function (Blueprint $table) {
            if (!Schema::hasColumn('services', 'cover_image')) {
                $table->string('cover_image')->nullable()->after('image');
            }
            if (!Schema::hasColumn('services', 'slug')) {
                $table->string('slug')->unique()->after('title');
            }
            // Description already exists, ensure it's longText
            if (Schema::hasColumn('services', 'description')) {
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
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['cover_image']);
        });
    }
};
