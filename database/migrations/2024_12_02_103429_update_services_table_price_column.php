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
        Schema::table('services', function (Blueprint $table) {
            // Drop the min_price and max_price columns
            $table->dropColumn(['min_price', 'max_price']);

            // Add the new price column
            $table->decimal('price', 10, 2)->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Add the min_price and max_price columns back
            $table->decimal('min_price', 10, 2)->nullable()->after('description');
            $table->decimal('max_price', 10, 2)->nullable()->after('min_price');

            // Drop the price column
            $table->dropColumn('price');
        });
    }
};
