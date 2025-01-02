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
        Schema::table('meetings', function (Blueprint $table) {
            $table->enum('status', ['requested', 'confirmed', 'cancelled', 'completed'])->default('requested')->change();
            $table->softDeletes(); // Adds the `deleted_at` column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table->enum('status', ['requested', 'confirmed', 'cancelled'])->default('requested')->change();
            $table->dropColumn('deleted_at');
        });
    }
};
