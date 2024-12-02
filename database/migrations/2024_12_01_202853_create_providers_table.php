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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->text('bio')->nullable();
            $table->text('certifications')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->date('date_of_birth')->nullable();
            $table->integer('years_of_experience')->nullable();
            $table->string('education')->nullable();
            $table->json('skills')->nullable();
            $table->json('languages_spoken')->nullable();
            $table->json('availability')->nullable();
            $table->decimal('hourly_rate', 8, 2)->nullable();
            $table->json('work_shifts')->nullable(); 
            $table->json('work_locations')->nullable();
            $table->boolean('background_checked')->default(false);
            $table->string('profile_picture')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->softDeletes(); // Adds `deleted_at` column for soft deletes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
