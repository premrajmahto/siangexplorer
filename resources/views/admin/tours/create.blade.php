@extends('layouts.admin')

@section('title', 'Create Tour Package')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Add New Tour Package</h1>
        <p class="text-xs text-slate-500 font-medium mt-0.5">Create tour package with day-wise itinerary, pricing, and gallery.</p>
    </div>
    <a href="{{ route('admin.tours.index') }}" class="inline-flex items-center space-x-2 text-xs font-bold text-slate-600 hover:text-slate-900 px-3.5 py-2 rounded-xl bg-white border border-slate-200">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Back to Tours</span>
    </a>
</div>

<form action="{{ route('admin.tours.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-5xl" x-data="{
    daysCount: 3,
    itineraries: [
        { day_number: 1, title: 'Arrival & Welcome', description: 'Airport pickup and hotel check-in.', morning_activity: 'Airport Transfer', afternoon_activity: 'Hotel Check-in & Leisure', evening_activity: 'Welcome Dinner', meals: 'Dinner', hotel: 'Grand Luxury Resort', transportation: 'Private AC Cab' },
        { day_number: 2, title: 'Full Day Sightseeing Tour', description: 'Explore local attractions and landmarks.', morning_activity: 'City Sightseeing Tour', afternoon_activity: 'Heritage Museum Visit', evening_activity: 'Local Market Shopping', meals: 'Breakfast, Lunch', hotel: 'Grand Luxury Resort', transportation: 'Private AC Coach' },
        { day_number: 3, title: 'Departure Day', description: 'Hotel check-out and drop to airport.', morning_activity: 'Souvenir Shopping', afternoon_activity: 'Hotel Check-out', evening_activity: 'Airport Transfer', meals: 'Breakfast', hotel: 'N/A', transportation: 'Private Cab' }
    ],
    addDay() {
        this.daysCount++;
        this.itineraries.push({
            day_number: this.daysCount,
            title: 'Day ' + this.daysCount + ' Activities',
            description: '',
            morning_activity: '',
            afternoon_activity: '',
            evening_activity: '',
            meals: 'Breakfast, Dinner',
            hotel: '',
            transportation: ''
        });
    },
    removeDay(index) {
        if(this.itineraries.length > 1) {
            this.itineraries.splice(index, 1);
            this.itineraries.forEach((item, idx) => item.day_number = idx + 1);
            this.daysCount = this.itineraries.length;
        }
    }
}">
    @csrf

    <!-- Basic Information -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-5">
        <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3">Basic Information</h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="md:col-span-2">
                <label for="title" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Package Title <span class="text-rose-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required placeholder="e.g. 5-Day Himachal Luxury Explorer" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
                @error('title') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="destination_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Destination <span class="text-rose-500">*</span></label>
                <select name="destination_id" id="destination_id" required class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
                    <option value="">Select Destination</option>
                    @foreach($destinations as $dest)
                        <option value="{{ $dest->id }}" {{ old('destination_id') == $dest->id ? 'selected' : '' }}>{{ $dest->name }} ({{ $dest->country }})</option>
                    @endforeach
                </select>
                @error('destination_id') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="category_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Category</label>
                <select name="category_id" id="category_id" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="tour_type_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Tour Type</label>
                <select name="tour_type_id" id="tour_type_id" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
                    <option value="">Select Tour Type</option>
                    @foreach($tourTypes as $tt)
                        <option value="{{ $tt->id }}" {{ old('tour_type_id') == $tt->id ? 'selected' : '' }}>{{ $tt->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label for="duration_days" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Days <span class="text-rose-500">*</span></label>
                    <input type="number" name="duration_days" id="duration_days" min="1" value="{{ old('duration_days', 3) }}" required class="w-full px-3 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
                </div>
                <div>
                    <label for="duration_nights" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Nights <span class="text-rose-500">*</span></label>
                    <input type="number" name="duration_nights" id="duration_nights" min="0" value="{{ old('duration_nights', 2) }}" required class="w-full px-3 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
                </div>
            </div>
        </div>

        <div>
            <label for="short_description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Short Overview (Snippet)</label>
            <textarea name="short_description" id="short_description" rows="2" placeholder="Summary overview displayed on tour cards..." class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">{{ old('short_description') }}</textarea>
        </div>

        <div>
            <label for="full_description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Full Package Details</label>
            <textarea name="full_description" id="full_description" rows="4" placeholder="Detailed itinerary introduction, highlight descriptions..." class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">{{ old('full_description') }}</textarea>
        </div>
    </div>

    <!-- Pricing & Capacity -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-5">
        <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3">Pricing & Traveler Capacity</h3>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
            <div>
                <label for="starting_price" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Starting Price (Base) <span class="text-rose-500">*</span></label>
                <input type="number" step="0.01" name="starting_price" id="starting_price" value="{{ old('starting_price') }}" required placeholder="14999.00" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>

            <div>
                <label for="discounted_price" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Offer / Discounted Price</label>
                <input type="number" step="0.01" name="discounted_price" id="discounted_price" value="{{ old('discounted_price') }}" placeholder="12499.00" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>

            <div>
                <label for="adult_price" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Adult Price</label>
                <input type="number" step="0.01" name="adult_price" id="adult_price" value="{{ old('adult_price') }}" placeholder="Per adult rate" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>

            <div>
                <label for="child_price" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Child Price</label>
                <input type="number" step="0.01" name="child_price" id="child_price" value="{{ old('child_price') }}" placeholder="Per child rate" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>

            <div>
                <label for="min_travelers" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Min Travelers</label>
                <input type="number" name="min_travelers" id="min_travelers" value="{{ old('min_travelers', 1) }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>

            <div>
                <label for="max_travelers" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Max Group Capacity</label>
                <input type="number" name="max_travelers" id="max_travelers" value="{{ old('max_travelers', 20) }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>
        </div>
    </div>

    <!-- Images & Media -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-5">
        <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3">Images & Media Gallery</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label for="cover_image" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Main Cover Photo</label>
                <input type="file" name="cover_image" id="cover_image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100">
            </div>

            <div>
                <label for="gallery_images" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Multiple Gallery Photos</label>
                <input type="file" name="gallery_images[]" id="gallery_images" multiple accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100">
            </div>
        </div>

        <div class="flex items-center space-x-6 pt-2">
            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="rounded text-brand-600 focus:ring-brand-500 w-4 h-4">
                <span class="text-xs font-bold text-slate-700">Featured Package</span>
            </label>

            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="checkbox" name="is_popular" value="1" {{ old('is_popular') ? 'checked' : '' }} class="rounded text-brand-600 focus:ring-brand-500 w-4 h-4">
                <span class="text-xs font-bold text-slate-700">Popular Package</span>
            </label>

            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }} class="rounded text-brand-600 focus:ring-brand-500 w-4 h-4">
                <span class="text-xs font-bold text-slate-700">Publish / Active</span>
            </label>
        </div>
    </div>

    <!-- Day-Wise Itinerary Builder -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-5">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <div>
                <h3 class="font-extrabold text-slate-900 text-sm">Day-Wise Itinerary Builder</h3>
                <p class="text-xs text-slate-500">Define daily morning, afternoon, evening activities, hotels, and meals.</p>
            </div>
            <button type="button" @click="addDay()" class="px-3.5 py-1.5 bg-slate-900 text-white text-xs font-bold rounded-xl hover:bg-slate-800 transition-all flex items-center space-x-1">
                <i class="fa-solid fa-plus"></i>
                <span>Add Day</span>
            </button>
        </div>

        <div class="space-y-4">
            <template x-for="(day, index) in itineraries" :key="index">
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 relative space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="font-extrabold text-xs text-brand-700 bg-brand-50 px-2.5 py-1 rounded-lg border border-brand-200">
                            Day <span x-text="day.day_number"></span>
                        </span>
                        <button type="button" @click="removeDay(index)" class="text-rose-500 hover:text-rose-700 text-xs font-bold">
                            <i class="fa-solid fa-trash mr-1"></i> Remove Day
                        </button>
                    </div>

                    <input type="hidden" :name="'itineraries['+index+'][day_number]'" :value="day.day_number">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold uppercase text-slate-500 mb-0.5">Day Title</label>
                            <input type="text" :name="'itineraries['+index+'][title]'" x-model="day.title" placeholder="e.g. Arrival in Delhi & Local Sightseeing" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold uppercase text-slate-500 mb-0.5">Included Meals</label>
                            <input type="text" :name="'itineraries['+index+'][meals]'" x-model="day.meals" placeholder="e.g. Breakfast, Dinner" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold uppercase text-slate-500 mb-0.5">Morning Activity</label>
                            <input type="text" :name="'itineraries['+index+'][morning_activity]'" x-model="day.morning_activity" placeholder="e.g. Airport pickup" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold uppercase text-slate-500 mb-0.5">Afternoon Activity</label>
                            <input type="text" :name="'itineraries['+index+'][afternoon_activity]'" x-model="day.afternoon_activity" placeholder="e.g. Hotel check-in" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold uppercase text-slate-500 mb-0.5">Evening Activity</label>
                            <input type="text" :name="'itineraries['+index+'][evening_activity]'" x-model="day.evening_activity" placeholder="e.g. Dinner & overnight stay" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold uppercase text-slate-500 mb-0.5">Hotel / Stay</label>
                            <input type="text" :name="'itineraries['+index+'][hotel]'" x-model="day.hotel" placeholder="Hotel name or category" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold uppercase text-slate-500 mb-0.5">Transportation</label>
                            <input type="text" :name="'itineraries['+index+'][transportation]'" x-model="day.transportation" placeholder="AC Cab / SUV / Bus" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300">
                        </div>

                        <div class="md:col-span-3">
                            <label class="block text-[10px] font-bold uppercase text-slate-500 mb-0.5">Day Description</label>
                            <textarea :name="'itineraries['+index+'][description]'" x-model="day.description" rows="2" placeholder="Detailed breakdown of activities..." class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300"></textarea>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Inclusions, Exclusions, Hotel & Transport -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-5">
        <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3">Inclusions, Exclusions & Travel Info</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label for="inclusions_text" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Inclusions (One per line or HTML)</label>
                <textarea name="inclusions_text" id="inclusions_text" rows="4" placeholder="• Hotel Accommodation&#10;• Daily Breakfast & Dinner&#10;• All Transfers in Private Cab" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">{{ old('inclusions_text') }}</textarea>
            </div>

            <div>
                <label for="exclusions_text" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Exclusions (One per line or HTML)</label>
                <textarea name="exclusions_text" id="exclusions_text" rows="4" placeholder="• Airfare / Train tickets&#10;• Personal Expenses & Laundry&#10;• Anything not mentioned in inclusions" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">{{ old('exclusions_text') }}</textarea>
            </div>

            <div>
                <label for="hotel_info" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Hotel Details</label>
                <textarea name="hotel_info" id="hotel_info" rows="3" placeholder="3-Star / 4-Star / Luxury Resort details..." class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">{{ old('hotel_info') }}</textarea>
            </div>

            <div>
                <label for="transport_info" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Transportation Details</label>
                <textarea name="transport_info" id="transport_info" rows="3" placeholder="Sedan / SUV / Tempo Traveller details..." class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">{{ old('transport_info') }}</textarea>
            </div>
        </div>
    </div>

    <!-- SEO Metadata -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-5">
        <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3">SEO Metadata</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label for="seo_title" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">SEO Title</label>
                <input type="text" name="seo_title" id="seo_title" value="{{ old('seo_title') }}" placeholder="Custom meta title" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>

            <div>
                <label for="seo_keywords" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">SEO Keywords</label>
                <input type="text" name="seo_keywords" id="seo_keywords" value="{{ old('seo_keywords') }}" placeholder="himachal package, luxury tour" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>
        </div>

        <div>
            <label for="seo_description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">SEO Description</label>
            <textarea name="seo_description" id="seo_description" rows="2" placeholder="Search snippet description..." class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">{{ old('seo_description') }}</textarea>
        </div>
    </div>

    <!-- Submit -->
    <div class="flex items-center justify-end space-x-3">
        <a href="{{ route('admin.tours.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition-all">Cancel</a>
        <button type="submit" class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-md shadow-brand-600/30 transition-all">
            Save Tour Package
        </button>
    </div>
</form>
@endsection
