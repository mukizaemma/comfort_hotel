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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('reception_phone')->nullable()->after('phone');
            $table->string('manager_phone')->nullable()->after('reception_phone');
            $table->string('restaurant_phone')->nullable()->after('manager_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['reception_phone', 'manager_phone', 'restaurant_phone']);
        });
    }
};

