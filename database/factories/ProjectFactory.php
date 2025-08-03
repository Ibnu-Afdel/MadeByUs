<?php

namespace Database\Factories;

use App\Enums\ProjectStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->generateProjectTitle();
        $description = $this->generateProjectDescription();
        $createdAt = fake()->dateTimeBetween('-6 months', 'now');
        
        return [
            'user_id' => User::factory(),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'description' => $description,
            'status' => fake()->randomElement(ProjectStatus::cases())->value,
            'is_featured' => false,
            'view_count' => fake()->numberBetween(0, 1000),
            'published_at' => fake()->boolean(70) ? $createdAt : null,
            'is_priority' => fake()->boolean(10), // 10% chance of being priority
            'created_at' => $createdAt,
            'updated_at' => fake()->dateTimeBetween($createdAt, 'now'),
        ];
    }

    /**
     * Generate a realistic project title.
     */
    private function generateProjectTitle(): string
    {
        $projectTypes = [
            'E-commerce Platform',
            'Task Management System',
            'Social Media Dashboard',
            'Learning Management System',
            'Real-time Chat Application',
            'Portfolio Website',
            'Blog Platform',
            'Inventory Management System',
            'Customer Relationship Manager',
            'Event Management Platform',
            'File Sharing Service',
            'API Gateway',
            'Content Management System',
            'Project Management Tool',
            'Video Streaming Platform',
            'Booking Management System',
            'Financial Dashboard',
            'Analytics Platform',
            'Authentication Service',
            'Mobile Banking App',
            'Food Delivery Platform',
            'Fitness Tracker App',
            'Weather Forecast App',
            'News Aggregator',
            'Recipe Sharing Platform',
            'Code Review Tool',
            'Documentation Generator',
            'Test Automation Framework',
            'CI/CD Pipeline Manager',
            'Monitoring Dashboard',
        ];

        $adjectives = [
            'Modern', 'Advanced', 'Smart', 'Innovative', 'Responsive', 'Scalable',
            'Secure', 'Fast', 'Intuitive', 'Professional', 'Comprehensive', 'Lightweight',
            'Powerful', 'Flexible', 'Robust', 'Elegant', 'Efficient', 'Interactive',
            'Dynamic', 'Progressive', 'Mobile-first', 'Cloud-native', 'AI-powered',
            'Real-time', 'Full-stack', 'Cross-platform', 'Open-source', 'Enterprise',
        ];

        $frameworks = [
            'Laravel', 'React', 'Vue.js', 'Next.js', 'Django', 'Express.js',
            'Spring Boot', 'Flutter', 'Angular', 'Node.js', 'Rails', 'FastAPI',
        ];

        $shouldIncludeAdjective = fake()->boolean(70);
        $shouldIncludeFramework = fake()->boolean(40);

        $title = '';
        
        if ($shouldIncludeAdjective) {
            $title .= fake()->randomElement($adjectives) . ' ';
        }

        $title .= fake()->randomElement($projectTypes);

        if ($shouldIncludeFramework) {
            $title .= ' with ' . fake()->randomElement($frameworks);
        }

        return $title;
    }

    /**
     * Generate a realistic project description.
     */
    private function generateProjectDescription(): string
    {
        $descriptions = [
            "A comprehensive web application built with modern technologies, featuring user authentication, real-time updates, and responsive design. The project includes admin dashboard, user management, and analytics features.",
            
            "Full-stack application designed for scalability and performance. Includes RESTful API, database optimization, automated testing, and deployment pipeline. Built following industry best practices and design patterns.",
            
            "Modern web platform with clean architecture and intuitive user interface. Features include data visualization, export functionality, notification system, and role-based access control.",
            
            "Responsive web application with focus on user experience and performance optimization. Implements progressive web app features, offline functionality, and cross-browser compatibility.",
            
            "Enterprise-grade solution with microservices architecture, automated testing, and CI/CD pipeline. Includes comprehensive documentation, monitoring, and error tracking.",
            
            "Mobile-first web application with real-time features and offline support. Built using modern JavaScript frameworks with server-side rendering and optimized performance.",
            
            "Scalable platform designed for high availability and performance. Features include load balancing, caching strategies, database replication, and comprehensive logging.",
            
            "Modern application with focus on security and data protection. Implements authentication, authorization, input validation, and follows OWASP security guidelines.",
            
            "Cloud-native application with containerized deployment and auto-scaling capabilities. Includes monitoring, logging, health checks, and disaster recovery features.",
            
            "Open-source project with extensive documentation and community contributions. Features modular architecture, plugin system, and comprehensive test coverage.",
        ];

        $baseDescription = fake()->randomElement($descriptions);
        
        // Add technical details 30% of the time
        if (fake()->boolean(30)) {
            $techDetails = [
                "\n\nTechnical highlights include optimized database queries, efficient caching mechanisms, and robust error handling.",
                "\n\nKey features: JWT authentication, real-time notifications, file upload system, and advanced search functionality.",
                "\n\nBuilt with performance in mind: lazy loading, code splitting, image optimization, and progressive enhancement.",
                "\n\nIncludes comprehensive test suite with unit tests, integration tests, and end-to-end testing coverage.",
                "\n\nDeployment ready with Docker containers, automated builds, and production monitoring setup.",
            ];
            
            $baseDescription .= fake()->randomElement($techDetails);
        }

        return $baseDescription;
    }

    /**
     * Indicate that the project is pending approval.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => ProjectStatus::PENDING->value,
            'published_at' => null,
        ]);
    }

    /**
     * Indicate that the project is approved.
     */
    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => ProjectStatus::APPROVED->value,
            'published_at' => fake()->dateTimeBetween($attributes['created_at'], 'now'),
        ]);
    }

    /**
     * Indicate that the project is rejected.
     */
    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => ProjectStatus::REJECTED->value,
            'published_at' => null,
        ]);
    }

    /**
     * Indicate that the project is featured.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
            'status' => ProjectStatus::APPROVED->value,
            'published_at' => fake()->dateTimeBetween($attributes['created_at'], 'now'),
            'view_count' => fake()->numberBetween(500, 5000), // Featured projects have more views
        ]);
    }

    /**
     * Indicate that the project is high priority.
     */
    public function priority(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_priority' => true,
        ]);
    }

    /**
     * Indicate that the project has high view count.
     */
    public function popular(): static
    {
        return $this->state(fn (array $attributes) => [
            'view_count' => fake()->numberBetween(1000, 10000),
            'status' => ProjectStatus::APPROVED->value,
            'published_at' => fake()->dateTimeBetween($attributes['created_at'], 'now'),
        ]);
    }

    /**
     * Indicate that the project was recently created.
     */
    public function recent(): static
    {
        $recentDate = fake()->dateTimeBetween('-1 week', 'now');
        
        return $this->state(fn (array $attributes) => [
            'created_at' => $recentDate,
            'updated_at' => $recentDate,
        ]);
    }
} 