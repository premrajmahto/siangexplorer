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
                'content' => '<h3>Welcome to SiangExplorer</h3><p>SiangExplorer is a premier tour & travel management company dedicated to curating extraordinary journeys across India and global destinations. We specialize in luxury honeymoon packages, family holidays, adventure expeditions, and corporate retreats.</p><p><strong>Destination Expert for:</strong> ASSAM | ARUNACHAL | MEGHALAYA | MANIPUR | MIZORAM | NAGALAND | TRIPURA | BHUTAN | SIKKIM | DARJEELING</p>',
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
                'content' => '<h3>Payment Terms</h3><ul><li><strong>30% of the total Tour Cost</strong> within 3 Days after Confirmation.</li><li><strong>70% of the total Tour Cost</strong> 7 Days before the Tour Starts.</li></ul><h3>Mandatory Travel Documents</h3><p><strong>ILP (Inner Line Permit)</strong> is mandatory for guests traveling to Arunachal Pradesh. For ILP, guests need to provide:</p><ul><li>1 Copy Passport Size Photograph</li><li>1 Copy Govt. Authorized Document (Passport / Aadhaar Card / Voter ID)</li></ul><h3>Destination Specialist</h3><p><strong>Destination Expert for:</strong> ASSAM | ARUNACHAL | MEGHALAYA | MANIPUR | MIZORAM | NAGALAND | TRIPURA | BHUTAN | SIKKIM | DARJEELING</p>',
                'is_published' => true,
            ],
            [
                'title' => 'Cancellation Policy',
                'slug' => 'cancellation-policy',
                'content' => '<h3>Cancellation Policy</h3><ul><li><strong>Before 30 Days from Tour Start Date</strong> – Full Refund</li><li><strong>30 – 21 Days from Tour Start Date</strong> – 75% refund</li><li><strong>21 – 14 Days from Tour Start Date</strong> – 50% refund</li><li><strong>14 – 7 Days from Tour Start Date</strong> – 25% refund</li><li><strong>Within 7 Days from Tour Start Date</strong> – No Refund</li></ul><p><em>Please note: We charge 3% of the total amount of booking as our service fee in case of any cancellation over and above the above cancellation charges.</em></p>',
                'is_published' => true,
            ],
            [
                'title' => 'Refund Policy',
                'slug' => 'refund-policy',
                'content' => '<h3>Refund Process</h3><p>Approved refunds are processed back to the original payment method within 5-7 business days as per our Cancellation Policy.</p>',
                'is_published' => true,
            ],
        ];

        foreach ($pages as $p) {
            Page::updateOrCreate(['slug' => $p['slug']], $p);
        }
    }
}
