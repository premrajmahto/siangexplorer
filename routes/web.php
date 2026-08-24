<?php

use App\Http\Controllers\Admin\AdminBikeRentalController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminCouponController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDestinationController;
use App\Http\Controllers\Admin\AdminEnquiryController;
use App\Http\Controllers\Admin\AdminHeroSlideController;
use App\Http\Controllers\Admin\AdminHotelController;
use App\Http\Controllers\Admin\AdminServiceEnquiryController;


use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminTourController;
use App\Http\Controllers\Admin\AdminTransportationController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Customer\CustomerAuthController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Frontend\BikeRentalController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\DestinationController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\HotelController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\SeoController;
use App\Http\Controllers\Frontend\TourController;
use App\Http\Controllers\Frontend\TransportationController;
use Illuminate\Support\Facades\Route;

// SEO Routes
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('seo.sitemap');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('seo.robots');

// Public Website Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tours', [TourController::class, 'index'])->name('tours.index');
Route::get('/tours/{slug}', [TourController::class, 'show'])->name('tours.show');

Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{slug}', [DestinationController::class, 'show'])->name('destinations.show');

// Services Routes: Hotels, Cab Rentals, Bike Rentals
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{slug}', [HotelController::class, 'show'])->name('hotels.show');
Route::post('/hotels/{hotel}/book', [HotelController::class, 'book'])->name('hotels.book');

Route::get('/transportation', [TransportationController::class, 'index'])->name('transportation.index');
Route::post('/transportation/{vehicle}/book', [TransportationController::class, 'book'])->name('transportation.book');

Route::get('/bikes', [BikeRentalController::class, 'index'])->name('bikes.index');
Route::post('/bikes/{bike}/book', [BikeRentalController::class, 'book'])->name('bikes.book');

Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::post('/newsletter/subscribe', [ContactController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.show');


// Booking Transactions
Route::post('/booking/{tour}', [BookingController::class, 'process'])->name('booking.process');
Route::get('/booking/confirmation/{reference}', [BookingController::class, 'confirmation'])->name('booking.confirmation');
Route::post('/enquiry', [ContactController::class, 'submit'])->name('enquiry.submit');

// Customer Guest Auth Routes
Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('logout');
Route::middleware('guest:web')->group(function () {

    Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [CustomerAuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [CustomerAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [CustomerAuthController::class, 'register'])->name('register.submit');
});

// Customer Authenticated Account Portal Routes
Route::middleware('auth:web')->prefix('customer')->name('customer.')->group(function () {
    Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/bookings', [CustomerDashboardController::class, 'bookings'])->name('bookings');
    Route::get('/bookings/{booking}', [CustomerDashboardController::class, 'showBooking'])->name('bookings.show');
    Route::get('/profile', [CustomerDashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [CustomerDashboardController::class, 'updateProfile'])->name('profile.update');
});

// Admin Routes Group
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Guest Routes (Login)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');
    });

    // Admin Authenticated Routes
    Route::middleware('admin.auth')->group(function () {
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [AdminDashboardController::class, 'index']);

        // Destination Management Routes
        Route::resource('destinations', AdminDestinationController::class);

        // Tour Management Routes
        Route::get('/tours/categories', [AdminTourController::class, 'categories'])->name('tours.categories');
        Route::post('/tours/categories', [AdminTourController::class, 'storeCategory'])->name('tours.categories.store');
        Route::get('/tours/types', [AdminTourController::class, 'types'])->name('tours.types');
        Route::post('/tours/types', [AdminTourController::class, 'storeType'])->name('tours.types.store');
        Route::get('/tours/{tour}/duplicate', [AdminTourController::class, 'duplicate'])->name('tours.duplicate');
        Route::delete('/tours/gallery/{image}', [AdminTourController::class, 'deleteGalleryImage'])->name('tours.gallery.delete');
        Route::resource('tours', AdminTourController::class);

        // Services Management Routes
        Route::resource('hero-slides', AdminHeroSlideController::class);
        Route::resource('hotels', AdminHotelController::class);
        Route::resource('transportation', AdminTransportationController::class);
        Route::resource('bikes', AdminBikeRentalController::class);


        // Booking Management
        Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
        Route::get('/bookings/{booking}', [AdminBookingController::class, 'show'])->name('bookings.show');
        Route::patch('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.updateStatus');
        Route::delete('/bookings/{booking}', [AdminBookingController::class, 'destroy'])->name('bookings.destroy');

        // Customer Management
        Route::get('/customers', [AdminCustomerController::class, 'index'])->name('customers.index');
        Route::get('/customers/{customer}', [AdminCustomerController::class, 'show'])->name('customers.show');

        // General Enquiry Desk & Leads
        Route::get('/enquiries', [AdminEnquiryController::class, 'index'])->name('enquiries.index');
        Route::get('/enquiries/{enquiry}', [AdminEnquiryController::class, 'show'])->name('enquiries.show');
        Route::patch('/enquiries/{enquiry}/status', [AdminEnquiryController::class, 'updateStatus'])->name('enquiries.updateStatus');
        Route::post('/enquiries/{enquiry}/notes', [AdminEnquiryController::class, 'addNote'])->name('enquiries.addNote');

        // Service Enquiries (Cab, Bike & Hotel Bookings)
        Route::get('/service-enquiries', [AdminServiceEnquiryController::class, 'index'])->name('service-enquiries.index');
        Route::patch('/service-enquiries/{serviceEnquiry}/status', [AdminServiceEnquiryController::class, 'updateStatus'])->name('service-enquiries.updateStatus');
        Route::delete('/service-enquiries/{serviceEnquiry}', [AdminServiceEnquiryController::class, 'destroy'])->name('service-enquiries.destroy');



        // Marketing / Coupons
        Route::get('/coupons', [AdminCouponController::class, 'index'])->name('coupons.index');
        Route::post('/coupons', [AdminCouponController::class, 'store'])->name('coupons.store');
        Route::delete('/coupons/{coupon}', [AdminCouponController::class, 'destroy'])->name('coupons.destroy');
        Route::get('/newsletter', fn () => redirect()->route('admin.dashboard'))->name('newsletter.index');

        // CMS Placeholders
        Route::get('/blog', fn () => redirect()->route('admin.dashboard'))->name('blog.index');
        Route::get('/pages', fn () => redirect()->route('admin.dashboard'))->name('pages.index');
        Route::get('/testimonials', fn () => redirect()->route('admin.dashboard'))->name('testimonials.index');
        Route::get('/faqs', fn () => redirect()->route('admin.dashboard'))->name('faqs.index');
        Route::get('/gallery', fn () => redirect()->route('admin.dashboard'))->name('gallery.index');

        // Reports & Settings
        Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
        Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::put('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
    });
});
