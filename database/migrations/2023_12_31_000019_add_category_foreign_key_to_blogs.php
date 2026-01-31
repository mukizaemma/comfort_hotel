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
        if (Schema::hasTable('blogs') && Schema::hasTable('categories')) {
            Schema::table('blogs', function (Blueprint $table) {
                // Check if foreign key doesn't exist before adding
                if (!$this->foreignKeyExists('blogs', 'blogs_category_id_foreign')) {
                    $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('blogs')) {
            Schema::table('blogs', function (Blueprint $table) {
                $table->dropForeign(['category_id']);
            });
        }
    }

    /**
     * Check if foreign key exists
     */
    private function foreignKeyExists($table, $keyName)
    {
        $connection = Schema::getConnection();
        $database = $connection->getDatabaseName();
        
        $result = $connection->select(
            "SELECT CONSTRAINT_NAME 
             FROM information_schema.KEY_COLUMN_USAGE 
             WHERE TABLE_SCHEMA = ? 
             AND TABLE_NAME = ? 
             AND CONSTRAINT_NAME = ?",
            [$database, $table, $keyName]
        );
        
        return count($result) > 0;
    }
};
