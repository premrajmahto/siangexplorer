<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTourRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'destination_id' => ['required', 'exists:destinations,id'],
            'category_id' => ['nullable', 'exists:tour_categories,id'],
            'tour_type_id' => ['nullable', 'exists:tour_types,id'],
            'duration_days' => ['required', 'integer', 'min:1'],
            'duration_nights' => ['required', 'integer', 'min:0'],
            'starting_price' => ['required', 'numeric', 'min:0'],
            'discounted_price' => ['nullable', 'numeric', 'min:0'],
            'adult_price' => ['nullable', 'numeric', 'min:0'],
            'child_price' => ['nullable', 'numeric', 'min:0'],
            'currency' => ['nullable', 'string', 'max:10'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'gallery_images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'max_travelers' => ['nullable', 'integer', 'min:1'],
            'min_travelers' => ['nullable', 'integer', 'min:1'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'full_description' => ['nullable', 'string'],
            'inclusions_text' => ['nullable', 'string'],
            'exclusions_text' => ['nullable', 'string'],
            'hotel_info' => ['nullable', 'string'],
            'transport_info' => ['nullable', 'string'],
            'important_info' => ['nullable', 'string'],
            'terms_conditions' => ['nullable', 'string'],
            'is_featured' => ['boolean'],
            'is_popular' => ['boolean'],
            'is_active' => ['boolean'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'seo_keywords' => ['nullable', 'string', 'max:255'],

            // Itinerary items
            'itineraries' => ['nullable', 'array'],
            'itineraries.*.day_number' => ['required_with:itineraries', 'integer'],
            'itineraries.*.title' => ['required_with:itineraries', 'string', 'max:255'],
            'itineraries.*.description' => ['nullable', 'string'],
            'itineraries.*.morning_activity' => ['nullable', 'string', 'max:255'],
            'itineraries.*.afternoon_activity' => ['nullable', 'string', 'max:255'],
            'itineraries.*.evening_activity' => ['nullable', 'string', 'max:255'],
            'itineraries.*.meals' => ['nullable', 'string', 'max:255'],
            'itineraries.*.hotel' => ['nullable', 'string', 'max:255'],
            'itineraries.*.transportation' => ['nullable', 'string', 'max:255'],
        ];
    }
}
