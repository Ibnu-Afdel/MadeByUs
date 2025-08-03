<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Project;
use App\Models\User;
use App\Enums\ProjectStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createCommentsForFeaturedProjects();
        $this->createCommentsForApprovedProjects();
        $this->createCommentsForRecentProjects();
        
        $this->command->info('Comments created successfully!');
        $this->displayCommentStats();
    }

    /**
     * Create more comments for featured projects.
     */
    private function createCommentsForFeaturedProjects(): void
    {
        $featuredProjects = Project::where('is_featured', true)->get();
        $users = User::role(['User', 'Premium', 'Admin', 'Moderator'])->get();

        foreach ($featuredProjects as $project) {
            // Featured projects get 8-15 comments
            $commentCount = rand(8, 15);
            
            // Mix of different comment types
            $technicalCount = ceil($commentCount * 0.3);
            $positiveCount = ceil($commentCount * 0.4);
            $questionCount = ceil($commentCount * 0.3);

            // Create technical comments
            Comment::factory()
                ->count($technicalCount)
                ->technical()
                ->recycle($users)
                ->create([
                    'project_id' => $project->id,
                ]);

            // Create positive feedback comments
            Comment::factory()
                ->count($positiveCount)
                ->positive()
                ->recycle($users)
                ->create([
                    'project_id' => $project->id,
                ]);

            // Create question comments
            Comment::factory()
                ->count($questionCount)
                ->question()
                ->recycle($users)
                ->create([
                    'project_id' => $project->id,
                ]);
        }
    }

    /**
     * Create comments for approved projects.
     */
    private function createCommentsForApprovedProjects(): void
    {
        $approvedProjects = Project::where('status', ProjectStatus::APPROVED)
            ->where('is_featured', false)
            ->get();
        
        $users = User::role(['User', 'Premium', 'Admin', 'Moderator'])->get();

        foreach ($approvedProjects as $project) {
            // Regular approved projects get 0-8 comments (some might have no comments)
            $commentCount = rand(0, 8);
            
            if ($commentCount === 0) {
                continue; // Skip this project (no comments)
            }

            // For projects with high view counts, increase comment probability
            if ($project->view_count > 1000) {
                $commentCount = rand(3, 8);
            }

            // Create mixed types of comments
            Comment::factory()
                ->count($commentCount)
                ->recycle($users)
                ->create([
                    'project_id' => $project->id,
                ]);

            // 30% chance of having a technical comment for popular projects
            if ($project->view_count > 500 && fake()->boolean(30)) {
                Comment::factory()
                    ->technical()
                    ->recycle($users)
                    ->create([
                        'project_id' => $project->id,
                    ]);
            }
        }
    }

    /**
     * Create comments for recent projects.
     */
    private function createCommentsForRecentProjects(): void
    {
        $recentProjects = Project::where('created_at', '>=', now()->subWeek())
            ->where('status', ProjectStatus::APPROVED)
            ->get();
        
        $users = User::role(['User', 'Premium', 'Admin', 'Moderator'])->get();

        foreach ($recentProjects as $project) {
            // Recent projects get 1-5 comments
            $commentCount = rand(1, 5);
            
            // Create recent comments
            Comment::factory()
                ->count($commentCount)
                ->recent()
                ->recycle($users)
                ->create([
                    'project_id' => $project->id,
                ]);

            // Higher chance of positive feedback for recent projects
            if (fake()->boolean(60)) {
                Comment::factory()
                    ->positive()
                    ->recent()
                    ->recycle($users)
                    ->create([
                        'project_id' => $project->id,
                    ]);
            }
        }
    }

    /**
     * Display comment creation statistics.
     */
    private function displayCommentStats(): void
    {
        $totalComments = Comment::count();
        $projectsWithComments = Project::has('comments')->count();
        $totalProjects = Project::count();
        $avgCommentsPerProject = $totalProjects > 0 ? round($totalComments / $totalProjects, 2) : 0;
        
        $featuredProjectComments = Comment::whereHas('project', function ($query) {
            $query->where('is_featured', true);
        })->count();

        $recentComments = Comment::where('created_at', '>=', now()->subWeek())->count();

        $stats = [
            ['Total Comments', $totalComments],
            ['Projects with Comments', $projectsWithComments],
            ['Projects without Comments', $totalProjects - $projectsWithComments],
            ['Avg Comments per Project', $avgCommentsPerProject],
            ['Comments on Featured Projects', $featuredProjectComments],
            ['Recent Comments (Last Week)', $recentComments],
        ];

        $this->command->table(['Metric', 'Value'], $stats);

        // Show top commented projects
        $topCommentedProjects = Project::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->limit(5)
            ->get(['title', 'comments_count', 'is_featured']);

        if ($topCommentedProjects->isNotEmpty()) {
            $this->command->info("\nTop 5 Most Commented Projects:");
            $projectStats = $topCommentedProjects->map(function ($project) {
                return [
                    'title' => Str::limit($project->title, 40),
                    'comments' => $project->comments_count,
                    'featured' => $project->is_featured ? 'Yes' : 'No',
                ];
            })->toArray();

            $this->command->table(['Project Title', 'Comments', 'Featured'], $projectStats);
        }
    }
} 