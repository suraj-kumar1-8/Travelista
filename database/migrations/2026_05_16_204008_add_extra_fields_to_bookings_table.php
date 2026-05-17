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
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('coupon_id')->nullable()->constrained('coupons')->onDelete('set null');
            $table->string('coupon_code')->nullable();
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->decimal('subtotal', 12, 2)->nullable();
            $table->decimal('tax_amount', 12, 2)->default(0);
            $table->foreignId('room_category_id')->nullable()->constrained('hotel_room_categories')->onDelete('set null');
            
            // Cancellation & Refund
            $table->string('cancellation_status')->nullable(); // requested, approved, rejected
            $table->text('cancellation_reason')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->string('refund_status')->default('none'); // none, processing, completed
            $table->decimal('refund_amount', 12, 2)->default(0);
            
            // Other fields
            $table->timestamp('itinerary_generated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['coupon_id']);
            $table->dropForeign(['room_category_id']);
            $table->dropColumn([
                'coupon_id',
                'coupon_code',
                'discount_amount',
                'subtotal',
                'tax_amount',
                'room_category_id',
                'cancellation_status',
                'cancellation_reason',
                'cancelled_at',
                'refund_status',
                'refund_amount',
                'itinerary_generated_at'
            ]);
        });
    }
};
