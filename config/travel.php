<?php

return [
    'currency' => env('TRAVEL_CURRENCY', 'INR'),
    'currency_symbol' => env('TRAVEL_CURRENCY_SYMBOL', '₹'),
    'tax_percentage' => (float) env('TRAVEL_TAX_PERCENTAGE', 5.00),
    'booking_prefix' => env('TRAVEL_BOOKING_PREFIX', 'TRV'),

    'statuses' => [
        'booking' => ['pending', 'confirmed', 'processing', 'completed', 'cancelled', 'rejected'],
        'payment' => ['pending', 'paid', 'partially_paid', 'failed', 'refunded'],
        'enquiry' => ['new', 'contacted', 'follow-up', 'converted', 'closed'],
    ],

    'tour_types' => [
        'Domestic',
        'International',
        'Honeymoon',
        'Family',
        'Adventure',
        'Religious',
        'Luxury',
        'Budget',
        'Group',
        'Corporate',
    ],
];
