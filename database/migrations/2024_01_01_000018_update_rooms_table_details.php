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
        if (!Schema::hasTable('rooms')) {
            return;
        }

        Schema::table('rooms', function (Blueprint $table) {
            if (!Schema::hasColumn('rooms', 'cover_image')) {
                $table->string('cover_image')->nullable()->after('image');
            }
            if (!Schema::hasColumn('rooms', 'slug')) {
                $table->string('slug')->unique()->after('title');
            }
            if (Schema::hasColumn('rooms', 'description')) {
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
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn(['cover_image']);
        });
    }
};
