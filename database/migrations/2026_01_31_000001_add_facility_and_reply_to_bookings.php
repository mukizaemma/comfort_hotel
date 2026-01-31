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
            if (!Schema::hasColumn('bookings', 'facility_id')) {
                $table->unsignedBigInteger('facility_id')->nullable()->after('room_id');
                $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('set null');
            }
            if (!Schema::hasColumn('bookings', 'reservation_type')) {
                $table->string('reservation_type', 20)->default('room')->after('facility_id'); // 'room' or 'facility'
            }
            if (!Schema::hasColumn('bookings', 'admin_reply')) {
                $table->text('admin_reply')->nullable()->after('message');
            }
            if (!Schema::hasColumn('bookings', 'admin_replied_at')) {
                $table->timestamp('admin_replied_at')->nullable()->after('admin_reply');
            }
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'facility_id')) {
                $table->dropForeign(['facility_id']);
                $table->dropColumn('facility_id');
            }
            if (Schema::hasColumn('bookings', 'reservation_type')) {
                $table->dropColumn('reservation_type');
            }
            if (Schema::hasColumn('bookings', 'admin_reply')) {
                $table->dropColumn('admin_reply');
            }
            if (Schema::hasColumn('bookings', 'admin_replied_at')) {
                $table->dropColumn('admin_replied_at');
            }
        });
    }
};
