<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'customer@siangexplorer.com'],
            [
                'name' => 'Demo Explorer Customer',
                'password' => 'password123',
                'phone' => '+91 99887 76655',
                'address' => '45 Luxury Avenue, Bandra West',
                'country' => 'India',
            ]
        );
    }
}
