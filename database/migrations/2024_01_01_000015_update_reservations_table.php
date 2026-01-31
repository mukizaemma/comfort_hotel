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
        if (!Schema::hasTable('reservations')) {
            return;
        }

        Schema::table('reservations', function (Blueprint $table) {
            $table->unsignedBigInteger('room_id')->nullable()->after('trip_id');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->date('checkin_date')->nullable()->after('date_in');
            $table->date('checkout_date')->nullable()->after('checkin_date');
            $table->decimal('total_amount', 10, 2)->default(0)->after('guests');
            $table->decimal('paid_amount', 10, 2)->default(0)->after('total_amount');
            $table->decimal('balance_amount', 10, 2)->default(0)->after('paid_amount');
            $table->enum('payment_status', ['pending', 'partial', 'paid', 'refunded'])->default('pending')->after('balance_amount');
            $table->enum('booking_type', ['online', 'walkin'])->default('online')->after('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['room_id']);
            $table->dropColumn([
                'room_id', 'checkin_date', 'checkout_date', 'total_amount', 
                'paid_amount', 'balance_amount', 'payment_status', 'booking_type'
            ]);
        });
    }
};
