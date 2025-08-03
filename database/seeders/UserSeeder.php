<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createAdminUsers();
        $this->createDevelopmentUsers();
        $this->createRegularUsers();
        
        $this->command->info('Users created successfully!');
    }

    /**
     * Create admin and moderator users for management.
     */
    private function createAdminUsers(): void
    {
        // Super Admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@madebyus.com'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'avatar' => 'https://ui-avatars.com/api/?name=Super+Admin&color=7F9CF5&background=EBF4FF',
            ]
        );
        $superAdmin->assignRole('Super Admin');

        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@madebyus.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'avatar' => 'https://ui-avatars.com/api/?name=Admin+User&color=10B981&background=D1FAE5',
            ]
        );
        $admin->assignRole('Admin');

        // Moderators
        $moderator1 = User::firstOrCreate(
            ['email' => 'moderator@madebyus.com'],
            [
                'name' => 'Sarah Wilson',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'avatar' => 'https://ui-avatars.com/api/?name=Sarah+Wilson&color=8B5CF6&background=F3E8FF',
            ]
        );
        $moderator1->assignRole('Moderator');

        $moderator2 = User::firstOrCreate(
            ['email' => 'mod2@madebyus.com'],
            [
                'name' => 'James Rodriguez',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'avatar' => 'https://ui-avatars.com/api/?name=James+Rodriguez&color=F59E0B&background=FEF3C7',
            ]
        );
        $moderator2->assignRole('Moderator');
    }

    /**
     * Create users for development and testing.
     */
    private function createDevelopmentUsers(): void
    {
        // Test user for general testing
        $testUser = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'avatar' => 'https://ui-avatars.com/api/?name=Test+User&color=EF4444&background=FEE2E2',
            ]
        );
        $testUser->assignRole('User');

        // Premium test user
        $premiumUser = User::firstOrCreate(
            ['email' => 'premium@example.com'],
            [
                'name' => 'Premium User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'avatar' => 'https://ui-avatars.com/api/?name=Premium+User&color=F97316&background=FED7AA',
            ]
        );
        $premiumUser->assignRole('Premium');

        // Social login test users
        $githubUser = User::factory()
            ->socialLogin('github')
            ->create([
                'name' => 'GitHub User',
                'email' => 'github@example.com',
                'email_verified_at' => now(),
            ]);
        $githubUser->assignRole('User');

        $googleUser = User::factory()
            ->socialLogin('google')
            ->create([
                'name' => 'Google User',
                'email' => 'google@example.com',
                'email_verified_at' => now(),
            ]);
        $googleUser->assignRole('User');
    }

    /**
     * Create regular users with various roles.
     */
    private function createRegularUsers(): void
    {
        // Create premium users (5)
        User::factory()
            ->count(5)
            ->withAvatar()
            ->create()
            ->each(function (User $user) {
                $user->assignRole('Premium');
            });

        // Create regular users (20)
        User::factory()
            ->count(20)
            ->create()
            ->each(function (User $user) {
                $user->assignRole('User');
            });

        // Create some users with social login (8)
        collect(['github', 'google', 'twitter', 'facebook'])->each(function (string $provider) {
            User::factory()
                ->count(2)
                ->socialLogin($provider)
                ->create()
                ->each(function (User $user) {
                    $user->assignRole('User');
                });
        });

        // Create some unverified users (3)
        User::factory()
            ->count(3)
            ->unverified()
            ->create()
            ->each(function (User $user) {
                $user->assignRole('Guest');
            });
    }
} 