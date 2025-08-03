<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use App\Enums\ProjectStatus;
use Illuminate\Database\Seeder;
use Spatie\Tags\Tag;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createTags();
        $this->createFeaturedProjects();
        $this->createApprovedProjects();
        $this->createPendingProjects();
        $this->createRejectedProjects();
        $this->createPriorityProjects();
        
        $this->command->info('Projects created successfully!');
        $this->displayProjectStats();
    }

    /**
     * Create commonly used tags.
     */
    private function createTags(): void
    {
        $tags = [
            // Technology tags
            'PHP', 'Laravel', 'JavaScript', 'Vue.js', 'React', 'TypeScript', 'Node.js',
            'Python', 'Django', 'Flask', 'Java', 'Spring Boot', 'C#', '.NET',
            'Ruby', 'Rails', 'Go', 'Rust', 'Swift', 'Kotlin', 'Flutter', 'Dart',
            
            // Framework/Library tags
            'Bootstrap', 'Tailwind CSS', 'Alpine.js', 'jQuery', 'Express.js',
            'FastAPI', 'Next.js', 'Nuxt.js', 'Svelte', 'Angular',
            
            // Database tags
            'MySQL', 'PostgreSQL', 'MongoDB', 'Redis', 'SQLite', 'Firebase',
            
            // Category tags
            'Web Development', 'Mobile App', 'Desktop App', 'API', 'CLI Tool',
            'Game Development', 'Machine Learning', 'AI', 'Blockchain', 'IoT',
            'E-commerce', 'Social Media', 'Portfolio', 'Blog', 'CMS',
            'Dashboard', 'Analytics', 'Productivity', 'Education', 'Healthcare',
            
            // Difficulty/Type tags
            'Beginner Friendly', 'Advanced', 'Open Source', 'Commercial', 'Side Project',
            'MVP', 'Prototype', 'Production Ready', 'Work in Progress', 'Completed',
        ];

        foreach ($tags as $tagName) {
            Tag::findOrCreate($tagName);
        }
    }

    /**
     * Create 3 featured projects with different view counts.
     */
    private function createFeaturedProjects(): void
    {
        $premiumUsers = User::role('Premium')->get();
        $adminUsers = User::role(['Admin', 'Super Admin'])->get();
        $featuredUsers = $premiumUsers->merge($adminUsers)->take(3);

        // Featured Project 1 - Highest views
        $project1 = Project::factory()
            ->featured()
            ->create([
                'user_id' => $featuredUsers->get(0)?->id ?? User::factory()->create()->id,
                'title' => 'Advanced Laravel E-commerce Platform',
                'description' => "A comprehensive e-commerce solution built with Laravel 11, featuring multi-vendor support, advanced payment integration, inventory management, and real-time notifications. Includes admin dashboard, customer portal, and mobile-responsive design.\n\nKey Features:\n• Multi-vendor marketplace\n• Stripe & PayPal integration\n• Real-time inventory tracking\n• Advanced search & filtering\n• Order management system\n• Customer reviews & ratings\n• Responsive design",
                'view_count' => 4750,
                'is_priority' => true,
            ]);
        $project1->attachTags(['Laravel', 'PHP', 'E-commerce', 'Stripe', 'MySQL', 'Vue.js', 'Production Ready']);

        // Featured Project 2 - Medium-high views
        $project2 = Project::factory()
            ->featured()
            ->create([
                'user_id' => $featuredUsers->get(1)?->id ?? User::factory()->create()->id,
                'title' => 'Real-time Chat Application with WebSockets',
                'description' => "Modern real-time chat application built with Node.js, Socket.io, and React. Features include private messaging, group chats, file sharing, message encryption, and user presence indicators.\n\nTechnical Highlights:\n• WebSocket implementation\n• End-to-end encryption\n• File upload & sharing\n• Emoji support\n• Push notifications\n• Dark/Light themes\n• Mobile responsive",
                'view_count' => 3250,
                'is_priority' => false,
            ]);
        $project2->attachTags(['Node.js', 'React', 'Socket.io', 'JavaScript', 'MongoDB', 'Real-time', 'Open Source']);

        // Featured Project 3 - Medium views
        $project3 = Project::factory()
            ->featured()
            ->create([
                'user_id' => $featuredUsers->get(2)?->id ?? User::factory()->create()->id,
                'title' => 'AI-Powered Task Management Dashboard',
                'description' => "Intelligent task management system that uses machine learning to predict task completion times, suggest priorities, and optimize workflows. Built with Python Django and integrated with various productivity tools.\n\nAI Features:\n• Smart deadline predictions\n• Automatic task categorization\n• Workload optimization\n• Progress analytics\n• Integration with popular tools\n• Team collaboration features",
                'view_count' => 2180,
                'is_priority' => true,
            ]);
        $project3->attachTags(['Python', 'Django', 'Machine Learning', 'AI', 'PostgreSQL', 'Dashboard', 'Productivity']);
    }

    /**
     * Create approved projects.
     */
    private function createApprovedProjects(): void
    {
        $users = User::role(['User', 'Premium', 'Moderator'])->get();
        
        Project::factory()
            ->count(25)
            ->approved()
            ->recycle($users)
            ->create()
            ->each(function (Project $project) {
                $this->attachRandomTags($project);
            });

        // Create some popular approved projects
        Project::factory()
            ->count(8)
            ->approved()
            ->popular()
            ->recycle($users)
            ->create()
            ->each(function (Project $project) {
                $this->attachRandomTags($project);
            });
    }

    /**
     * Create pending projects (awaiting approval).
     */
    private function createPendingProjects(): void
    {
        $users = User::role(['User', 'Premium'])->get();
        
        // Recent pending projects
        Project::factory()
            ->count(15)
            ->pending()
            ->recent()
            ->recycle($users)
            ->create()
            ->each(function (Project $project) {
                $this->attachRandomTags($project);
            });

        // Older pending projects
        Project::factory()
            ->count(8)
            ->pending()
            ->recycle($users)
            ->create()
            ->each(function (Project $project) {
                $this->attachRandomTags($project);
            });
    }

    /**
     * Create rejected projects.
     */
    private function createRejectedProjects(): void
    {
        $users = User::role(['User', 'Premium'])->get();
        
        Project::factory()
            ->count(5)
            ->rejected()
            ->recycle($users)
            ->create()
            ->each(function (Project $project) {
                $this->attachRandomTags($project);
            });
    }

    /**
     * Create priority projects.
     */
    private function createPriorityProjects(): void
    {
        $premiumUsers = User::role('Premium')->get();
        
        Project::factory()
            ->count(7)
            ->priority()
            ->approved()
            ->recycle($premiumUsers)
            ->create()
            ->each(function (Project $project) {
                $this->attachRandomTags($project);
            });
    }

    /**
     * Attach random tags to a project.
     */
    private function attachRandomTags(Project $project): void
    {
        $allTags = Tag::all();
        $randomTags = $allTags->random(rand(2, 6));
        
        $project->attachTags($randomTags->pluck('name')->toArray());
    }

    /**
     * Display project creation statistics.
     */
    private function displayProjectStats(): void
    {
        $stats = [
            ['Status', 'Count'],
            ['Featured', Project::where('is_featured', true)->count()],
            ['Approved', Project::where('status', ProjectStatus::APPROVED)->count()],
            ['Pending', Project::where('status', ProjectStatus::PENDING)->count()],
            ['Rejected', Project::where('status', ProjectStatus::REJECTED)->count()],
            ['Priority', Project::where('is_priority', true)->count()],
            ['Total', Project::count()],
        ];

        $this->command->table(['Metric', 'Value'], $stats);
    }
} 