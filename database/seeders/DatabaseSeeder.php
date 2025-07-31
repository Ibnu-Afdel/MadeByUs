<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'create projects',
            'approve projects',
            'edit any project',
            'delete any project',
            'create comments',
            'delete any comment',
            'access admin panel',
            'manage users',
            'manage roles',
            'submit priority projects',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $moderatorRole = Role::firstOrCreate(['name' => 'Moderator']);
        $userRole = Role::firstOrCreate(['name' => 'User']);
        $premiumRole = Role::firstOrCreate(['name' => 'Premium']);

        // Assign permissions to roles
        $adminRole->givePermissionTo($permissions); // Admin gets all permissions

        $moderatorRole->givePermissionTo([
            'create projects',
            'approve projects',
            'edit any project',
            'create comments',
            'delete any comment',
            'access admin panel',
        ]);

        $premiumRole->givePermissionTo([
            'create projects',
            'edit any project',
            'create comments',
            'submit priority projects',
        ]);

        $userRole->givePermissionTo([
            'create projects',
            'create comments',
        ]);

        // Create users
        $adminUser = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        User::factory()->create([
            'name' => 'Test',
            'email' => 'test@example.com',
        ]);

        // Assign role to admin user
        $adminUser->assignRole($adminRole);
    }
}
