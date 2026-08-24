<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'About SiangExplorer',
                'slug' => 'about-us',
                'content' => '<h3>Welcome to SiangExplorer</h3><p>SiangExplorer is a premier tour & travel management company dedicated to curating extraordinary journeys across India and global destinations. We specialize in luxury honeymoon packages, family holidays, adventure expeditions, and corporate retreats.</p>',
                'is_published' => true,
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => '<h3>Privacy & Data Protection</h3><p>Your privacy is important to us. We collect customer information strictly for processing tour reservations, generating booking reference vouchers, and communicating trip updates. We never sell or share sensitive credentials with third parties.</p>',
                'is_published' => true,
            ],
            [
                'title' => 'Terms & Conditions',
                'slug' => 'terms-and-conditions',
                'content' => '<h3>Booking Terms & Conditions</h3><p>All tour bookings are subject to hotel availability and local travel permits. Prices are subject to government taxes and may vary based on peak season dates.</p>',
                'is_published' => true,
            ],
            [
                'title' => 'Cancellation Policy',
                'slug' => 'cancellation-policy',
                'content' => '<h3>Trip Cancellation Rules</h3><p>Cancellations made 15 days prior to travel date receive 90% refund. Cancellations between 7-14 days receive 50% refund. Cancellations within 7 days are non-refundable due to pre-booked hotel guarantees.</p>',
                'is_published' => true,
            ],
            [
                'title' => 'Refund Policy',
                'slug' => 'refund-policy',
                'content' => '<h3>Refund Process</h3><p>Approved refunds are processed back to the original payment method within 5-7 business days.</p>',
                'is_published' => true,
            ],
        ];

        foreach ($pages as $p) {
            Page::firstOrCreate(['slug' => $p['slug']], $p);
        }
    }
}
