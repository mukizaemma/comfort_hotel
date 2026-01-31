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
        if (!Schema::hasTable('galleries')) {
            return;
        }

        Schema::table('galleries', function (Blueprint $table) {
            $table->enum('media_type', ['image', 'video'])->default('image')->after('id');
            $table->string('video_path')->nullable()->after('image');
            $table->string('youtube_link')->nullable()->after('video_path');
            $table->string('thumbnail')->nullable()->after('youtube_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn(['media_type', 'video_path', 'youtube_link', 'thumbnail']);
        });
    }
};
