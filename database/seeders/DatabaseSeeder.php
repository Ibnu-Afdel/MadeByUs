<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * This seeder orchestrates the execution of all other seeders
     * in the proper order to maintain referential integrity.
     */
    public function run(): void
    {
        $this->command->info('🌱 Starting database seeding...');
        
        // Order is important due to foreign key constraints
        $this->call([
            RoleAndPermissionSeeder::class,
            UserSeeder::class,
            ProjectSeeder::class,
            CommentSeeder::class,
        ]);

        $this->command->info('✅ Database seeding completed successfully!');
        
        // Display summary
        $this->displaySeedingSummary();
    }

    /**
     * Display a summary of what was seeded.
     */
    private function displaySeedingSummary(): void
    {
        $this->command->info("\n📊 Seeding Summary:");
        $this->command->line("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
        
        $this->command->info("🔐 Roles & Permissions: Set up complete permission system");
        $this->command->info("👥 Users: Created admin, moderator, premium, and regular users");
        $this->command->info("📁 Projects: Created projects with various statuses including 3 featured");
        $this->command->info("💬 Comments: Generated realistic comments for projects");
        
        $this->command->line("\n🚀 You can now:");
        $this->command->line("   • Login as superadmin@madebyus.com (password: password)");
        $this->command->line("   • Login as admin@madebyus.com (password: password)");
        $this->command->line("   • Login as test@example.com (password: password)");
        $this->command->line("   • Explore the Filament admin panel");
        $this->command->line("   • Test different user roles and permissions");
        
        $this->command->line("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
    }
}
