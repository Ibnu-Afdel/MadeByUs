<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions organized by feature
        $permissions = [
            // Project permissions
            'create projects',
            'edit own projects',
            'edit any project',
            'delete own projects',
            'delete any project',
            'approve projects',
            'reject projects',
            'feature projects',
            'submit priority projects',
            'view pending projects',

            // Comment permissions
            'create comments',
            'edit own comments',
            'edit any comment',
            'delete own comments',
            'delete any comment',
            'moderate comments',

            // User management permissions
            'access admin panel',
            'manage users',
            'manage roles',
            'manage permissions',
            'view user analytics',

            // System permissions
            'access file manager',
            'manage site settings',
            'view system logs',
            'backup database',
        ];

        // Create permissions
        collect($permissions)->each(function (string $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        });

        // Create roles and assign permissions
        $this->createRoles();
    }

    /**
     * Create roles and assign permissions.
     */
    private function createRoles(): void
    {
        // Super Admin Role (all permissions)
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        $superAdminRole->givePermissionTo(Permission::all());

        // Admin Role (most permissions except super admin specific ones)
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->givePermissionTo([
            'create projects',
            'edit own projects',
            'edit any project',
            'delete own projects',
            'delete any project',
            'approve projects',
            'reject projects',
            'feature projects',
            'view pending projects',
            'create comments',
            'edit own comments',
            'edit any comment',
            'delete own comments',
            'delete any comment',
            'moderate comments',
            'access admin panel',
            'manage users',
            'view user analytics',
            'access file manager',
            'manage site settings',
        ]);

        // Moderator Role (content moderation focused)
        $moderatorRole = Role::firstOrCreate(['name' => 'Moderator']);
        $moderatorRole->givePermissionTo([
            'create projects',
            'edit own projects',
            'edit any project',
            'delete own projects',
            'approve projects',
            'reject projects',
            'view pending projects',
            'create comments',
            'edit own comments',
            'edit any comment',
            'delete own comments',
            'delete any comment',
            'moderate comments',
            'access admin panel',
        ]);

        // Premium User Role (enhanced user with extra privileges)
        $premiumRole = Role::firstOrCreate(['name' => 'Premium']);
        $premiumRole->givePermissionTo([
            'create projects',
            'edit own projects',
            'delete own projects',
            'submit priority projects',
            'create comments',
            'edit own comments',
            'delete own comments',
        ]);

        // Regular User Role (basic permissions)
        $userRole = Role::firstOrCreate(['name' => 'User']);
        $userRole->givePermissionTo([
            'create projects',
            'edit own projects',
            'delete own projects',
            'create comments',
            'edit own comments',
            'delete own comments',
        ]);

        // Guest Role (very limited permissions)
        $guestRole = Role::firstOrCreate(['name' => 'Guest']);
        $guestRole->givePermissionTo([
            'create comments',
        ]);

        $this->command->info('Roles and permissions created successfully!');
        $this->command->table(
            ['Role', 'Permissions Count'],
            [
                ['Super Admin', $superAdminRole->permissions->count()],
                ['Admin', $adminRole->permissions->count()],
                ['Moderator', $moderatorRole->permissions->count()],
                ['Premium', $premiumRole->permissions->count()],
                ['User', $userRole->permissions->count()],
                ['Guest', $guestRole->permissions->count()],
            ]
        );
    }
} 