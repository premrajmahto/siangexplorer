<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tour_packages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->foreignId('destination_id')->constrained('destinations')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('tour_categories')->nullOnDelete();
            $table->foreignId('tour_type_id')->nullable()->constrained('tour_types')->nullOnDelete();
            $table->integer('duration_days')->default(1);
            $table->integer('duration_nights')->default(0);
            $table->decimal('starting_price', 10, 2);
            $table->decimal('discounted_price', 10, 2)->nullable();
            $table->decimal('adult_price', 10, 2)->nullable();
            $table->decimal('child_price', 10, 2)->nullable();
            $table->string('currency', 10)->default('INR');
            $table->string('cover_image')->nullable();
            $table->integer('max_travelers')->default(20);
            $table->integer('min_travelers')->default(1);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->boolean('is_active')->default(true);
            $table->longText('inclusions_text')->nullable();
            $table->longText('exclusions_text')->nullable();
            $table->text('hotel_info')->nullable();
            $table->text('transport_info')->nullable();
            $table->text('important_info')->nullable();
            $table->text('terms_conditions')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tour_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_package_id')->constrained('tour_packages')->onDelete('cascade');
            $table->string('image_path');
            $table->string('caption')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('tour_itineraries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_package_id')->constrained('tour_packages')->onDelete('cascade');
            $table->integer('day_number');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('morning_activity')->nullable();
            $table->string('afternoon_activity')->nullable();
            $table->string('evening_activity')->nullable();
            $table->string('meals')->nullable();
            $table->string('hotel')->nullable();
            $table->string('transportation')->nullable();
            $table->string('image')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tour_itineraries');
        Schema::dropIfExists('tour_images');
        Schema::dropIfExists('tour_packages');
    }
};
