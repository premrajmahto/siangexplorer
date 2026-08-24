<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Tour management
            ['name' => 'View Tours', 'slug' => 'tours.view', 'module' => 'tours'],
            ['name' => 'Create Tours', 'slug' => 'tours.create', 'module' => 'tours'],
            ['name' => 'Edit Tours', 'slug' => 'tours.edit', 'module' => 'tours'],
            ['name' => 'Delete Tours', 'slug' => 'tours.delete', 'module' => 'tours'],

            // Destination management
            ['name' => 'View Destinations', 'slug' => 'destinations.view', 'module' => 'destinations'],
            ['name' => 'Create Destinations', 'slug' => 'destinations.create', 'module' => 'destinations'],
            ['name' => 'Edit Destinations', 'slug' => 'destinations.edit', 'module' => 'destinations'],
            ['name' => 'Delete Destinations', 'slug' => 'destinations.delete', 'module' => 'destinations'],

            // Booking management
            ['name' => 'View Bookings', 'slug' => 'bookings.view', 'module' => 'bookings'],
            ['name' => 'Update Booking Status', 'slug' => 'bookings.update', 'module' => 'bookings'],
            ['name' => 'Delete Bookings', 'slug' => 'bookings.delete', 'module' => 'bookings'],

            // Enquiries
            ['name' => 'View Enquiries', 'slug' => 'enquiries.view', 'module' => 'enquiries'],
            ['name' => 'Manage Enquiries', 'slug' => 'enquiries.manage', 'module' => 'enquiries'],

            // Settings
            ['name' => 'Manage System Settings', 'slug' => 'settings.manage', 'module' => 'settings'],
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['slug' => $perm['slug']], $perm);
        }

        $superAdmin = Role::where('slug', 'super-admin')->first();
        if ($superAdmin) {
            $allPerms = Permission::all();
            $superAdmin->permissions()->sync($allPerms->pluck('id'));
        }
    }
}
