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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('destination_id')->constrained()->onDelete('cascade');
            $table->text('description');
            $table->string('location')->nullable();
            $table->integer('rating')->default(5);
            $table->string('image_url')->nullable();
            $table->json('amenities')->nullable();
            $table->decimal('price_per_night', 10, 2);
            $table->string('type')->nullable();
            $table->string('category')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
