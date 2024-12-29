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
        Schema::create('blog', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade'); // Service the blog relates to
            $table->morphs('writer'); // Handles users, providers, or admins as writers
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable(); // Blog image
            $table->longText('content');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Approval status
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog');
    }
};
