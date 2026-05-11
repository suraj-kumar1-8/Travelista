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
        Schema::table('hotels', function (Blueprint $table) {
            $table->json('images')->nullable();
            $table->string('status')->default('active'); // active, hidden
        });

        Schema::table('tour_packages', function (Blueprint $table) {
            $table->json('images')->nullable();
            $table->string('status')->default('active'); // active, hidden
        });

        Schema::table('destinations', function (Blueprint $table) {
            $table->json('images')->nullable();
            $table->string('status')->default('active'); // active, hidden
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn(['images', 'status']);
        });

        Schema::table('tour_packages', function (Blueprint $table) {
            $table->dropColumn(['images', 'status']);
        });

        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn(['images', 'status']);
        });
    }
};
