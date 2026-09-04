<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $superAdminRole = Role::where('slug', 'super-admin')->first();

        Admin::firstOrCreate(
            ['email' => env('ADMIN_EMAIL', 'booking.siangholidays@gmail.com')],
            [
                'name' => 'System Administrator',
                'password' => env('ADMIN_PASSWORD', 'password123'),
                'phone' => '+91 98765 43210',
                'role_id' => $superAdminRole?->id,
                'is_active' => true,
            ]
        );
    }
}
