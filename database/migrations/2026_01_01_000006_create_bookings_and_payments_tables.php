<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_reference')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('tour_package_id')->constrained('tour_packages')->onDelete('cascade');
            $table->date('travel_date');
            $table->integer('num_adults')->default(1);
            $table->integer('num_children')->default(0);
            $table->integer('num_travelers')->default(1);
            $table->decimal('base_price', 10, 2);
            $table->decimal('additional_charges', 10, 2)->default(0.00);
            $table->decimal('discount_amount', 10, 2)->default(0.00);
            $table->decimal('tax_amount', 10, 2)->default(0.00);
            $table->decimal('final_amount', 10, 2);
            $table->string('coupon_code')->nullable();
            $table->string('pickup_location')->nullable();
            $table->text('special_requests')->nullable();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('customer_country')->nullable();
            $table->string('booking_status')->default('pending'); // pending, confirmed, processing, completed, cancelled, rejected
            $table->string('payment_status')->default('pending'); // pending, paid, partially_paid, failed, refunded
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('booking_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->string('item_name');
            $table->decimal('item_price', 10, 2);
            $table->integer('quantity')->default(1);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->string('transaction_id')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('currency', 10)->default('INR');
            $table->string('payment_method')->default('manual'); // manual, cash, bank_transfer, razorpay, stripe
            $table->string('payment_status')->default('pending'); // pending, paid, failed, refunded
            $table->json('gateway_response')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('booking_items');
        Schema::dropIfExists('bookings');
    }
};
