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
            if (!Schema::hasColumn('rooms', 'room_number')) {
                $table->string('room_number')->unique()->nullable()->after('slug');
            }
            if (!Schema::hasColumn('rooms', 'room_status')) {
                $table->enum('room_status', ['available', 'occupied', 'reserved', 'maintenance'])->default('available')->after('status');
            }
            if (!Schema::hasColumn('rooms', 'max_occupancy')) {
                $table->integer('max_occupancy')->default(2)->after('couplePrice');
            }
            if (!Schema::hasColumn('rooms', 'bed_count')) {
                $table->integer('bed_count')->default(1)->after('max_occupancy');
            }
            if (!Schema::hasColumn('rooms', 'bed_type')) {
                $table->string('bed_type')->nullable()->after('bed_count');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn(['room_number', 'room_status', 'max_occupancy', 'bed_count', 'bed_type']);
        });
    }
};
