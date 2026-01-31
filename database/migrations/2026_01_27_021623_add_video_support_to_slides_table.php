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
        Schema::table('slides', function (Blueprint $table) {
            if (!Schema::hasColumn('slides', 'media_type')) {
                $table->enum('media_type', ['image', 'video'])->default('image')->after('image');
            }
            if (!Schema::hasColumn('slides', 'video_url')) {
                $table->string('video_url')->nullable()->after('media_type');
            }
            if (!Schema::hasColumn('slides', 'video_file')) {
                $table->string('video_file')->nullable()->after('video_url');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('slides', function (Blueprint $table) {
            if (Schema::hasColumn('slides', 'video_file')) {
                $table->dropColumn('video_file');
            }
            if (Schema::hasColumn('slides', 'video_url')) {
                $table->dropColumn('video_url');
            }
            if (Schema::hasColumn('slides', 'media_type')) {
                $table->dropColumn('media_type');
            }
        });
    }
};
