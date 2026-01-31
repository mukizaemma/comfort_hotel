<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('bookings')) {
            return;
        }

        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'tour_activity_id')) {
                $table->unsignedBigInteger('tour_activity_id')->nullable()->after('facility_id');
                $table->foreign('tour_activity_id')->references('id')->on('tour_activities')->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'tour_activity_id')) {
                $table->dropForeign(['tour_activity_id']);
                $table->dropColumn('tour_activity_id');
            }
        });
    }
};
