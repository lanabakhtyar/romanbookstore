<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    // Roles
    $adminRole = Role::firstOrCreate(['name' => 'admin']);
    $userRole  = Role::firstOrCreate(['name' => 'user']);

    // Permissions
    
    $permissions = [
         // Catalog
        'manage books',
        'manage book images',
        'manage authors',
        'manage genres',
        'manage languages',
        'manage translators',

        // Posts
        'create posts',
        'edit own posts',
        'delete own posts',
        'manage all posts',

        // Comments
        'create comments',
        'edit own comments',
        'delete own comments',
        'manage comments',

    ];

    foreach ($permissions as $permission) {
        Permission::firstOrCreate(['name' => $permission]);
    }

    // Assign permissions
    
    $adminRole->syncPermissions(Permission::all());
    $userRole->syncPermissions([
        'create posts',
        'edit own posts',
        'delete own posts',
        'create comments', 
        'edit own comments', 
        'delete own comments',
    ]);
    }
}
