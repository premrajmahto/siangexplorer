<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('destination_id')->constrained('destinations')->onDelete('cascade');
            $table->string('category')->default('4-Star'); // 3-Star, 4-Star, 5-Star, Luxury Resort
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->decimal('price_per_night', 10, 2);
            $table->string('cover_image')->nullable();
            $table->json('gallery')->nullable();
            $table->text('amenities')->nullable(); // Free WiFi, Pool, Spa, Breakfast, Parking
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('transportations', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_name');
            $table->string('slug')->unique();
            $table->string('vehicle_type')->default('SUV'); // Sedan, SUV, Luxury Van, Tempo Traveller, Bus
            $table->integer('capacity')->default(6);
            $table->decimal('price_per_day', 10, 2);
            $table->decimal('price_per_km', 10, 2)->nullable();
            $table->string('cover_image')->nullable();
            $table->text('features')->nullable(); // AC, Bluetooth, Luggage Carrier, Leather Seats, GPS
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('bike_rentals', function (Blueprint $table) {
            $table->id();
            $table->string('model_name');
            $table->string('slug')->unique();
            $table->string('bike_type')->default('Adventure'); // Cruiser, Adventure, Scooter, Royal Enfield
            $table->string('engine_capacity')->default('350cc');
            $table->decimal('daily_rate', 10, 2);
            $table->decimal('deposit_amount', 10, 2)->default(2000.00);
            $table->string('cover_image')->nullable();
            $table->string('location')->nullable();
            $table->boolean('is_available')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('service_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('service_type'); // hotel, transportation, bike
            $table->unsignedBigInteger('service_id')->nullable();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('num_guests')->nullable();
            $table->string('pickup_location')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->default('new'); // new, contacted, closed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_enquiries');
        Schema::dropIfExists('bike_rentals');
        Schema::dropIfExists('transportations');
        Schema::dropIfExists('hotels');
    }
};
