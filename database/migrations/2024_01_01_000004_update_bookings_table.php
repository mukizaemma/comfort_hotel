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
        if (!Schema::hasTable('bookings')) {
            return;
        }

        Schema::table('bookings', function (Blueprint $table) {
            $table->date('checkin_date')->nullable()->after('checkin');
            $table->date('checkout_date')->nullable()->after('checkout');
            $table->decimal('total_amount', 10, 2)->default(0)->after('rooms');
            $table->decimal('paid_amount', 10, 2)->default(0)->after('total_amount');
            $table->decimal('balance_amount', 10, 2)->default(0)->after('paid_amount');
            $table->enum('payment_status', ['pending', 'partial', 'paid', 'refunded'])->default('pending')->after('balance_amount');
            $table->enum('booking_type', ['online', 'walkin'])->default('online')->after('payment_status');
            $table->unsignedBigInteger('assigned_room_id')->nullable()->after('room_id');
            $table->foreign('assigned_room_id')->references('id')->on('rooms')->onDelete('set null');
            $table->unsignedBigInteger('checked_in_by')->nullable();
            $table->foreign('checked_in_by')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('checked_out_by')->nullable();
            $table->foreign('checked_out_by')->references('id')->on('users')->onDelete('set null');
            $table->timestamp('checked_in_at')->nullable();
            $table->timestamp('checked_out_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['assigned_room_id']);
            $table->dropForeign(['checked_in_by']);
            $table->dropForeign(['checked_out_by']);
            $table->dropColumn([
                'checkin_date', 'checkout_date', 'total_amount', 'paid_amount', 
                'balance_amount', 'payment_status', 'booking_type', 'assigned_room_id',
                'checked_in_by', 'checked_out_by', 'checked_in_at', 'checked_out_at'
            ]);
        });
    }
};
