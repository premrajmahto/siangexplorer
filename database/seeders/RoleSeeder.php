<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Super Admin',
                'slug' => 'super-admin',
                'description' => 'Full administrative access to all system features, settings, and users.',
            ],
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Administrative access to managing tours, bookings, enquiries, and CMS content.',
            ],
            [
                'name' => 'Manager',
                'slug' => 'manager',
                'description' => 'Access to managing tours, bookings, and customer enquiries.',
            ],
            [
                'name' => 'Staff',
                'slug' => 'staff',
                'description' => 'Limited operational access for viewing bookings and following up leads.',
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['slug' => $role['slug']], $role);
        }
    }
}
