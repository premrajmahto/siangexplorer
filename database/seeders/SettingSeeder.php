<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            'site_name' => 'SiangExplorer',
            'site_tagline' => 'Specialized in North East India. We also do Pan India and International Tours as well',
            'site_logo' => null,
            'site_favicon' => null,

            // Contact
            'contact_phone' => '+91 91272 11962',
            'contact_email' => 'support@siangexplorer.com',
            'contact_address' => 'Mazar Path, Guwahati, Assam, 781037',
            'whatsapp_number' => '+919127211962',

            // Social Media
            'social_facebook' => 'https://facebook.com/siangexplorer',
            'social_instagram' => 'https://instagram.com/siangexplorer',
            'social_youtube' => 'https://youtube.com/siangexplorer',
            'social_x' => 'https://x.com/siangexplorer',

            // Business
            'currency_code' => 'INR',
            'currency_symbol' => '₹',
            'tax_percentage' => '5.00',
            'booking_prefix' => 'TRV',

            // SEO Defaults
            'seo_default_title' => 'SiangExplorer | Specialized in North East India, Pan India & International Tours',
            'seo_default_description' => 'Specialized in North East India. We also do Pan India and International Tours with day-wise itineraries, luxury stays, and 24/7 travel concierge.',
            'seo_google_analytics' => 'G-XXXXXXXXXX',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }
    }
}
