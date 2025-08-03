<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $commentTypes = [
            'feedback' => [
                'Great work on this project!',
                'This is really impressive. Well done!',
                'Love the attention to detail here.',
                'Excellent implementation!',
                'This project inspired me to try something similar.',
                'Really clean and professional looking.',
                'Amazing! How long did this take you?',
            ],
            'questions' => [
                'What technologies did you use for this?',
                'Is the source code available somewhere?',
                'How did you handle the authentication part?',
                'Any plans to add more features?',
                'Would love to see a tutorial on this!',
                'What was the biggest challenge you faced?',
                'Is this project still being maintained?',
            ],
            'technical' => [
                'Have you considered using TypeScript for better type safety?',
                'The API design looks solid. REST or GraphQL?',
                'Nice use of design patterns here.',
                'Performance looks good. Any specific optimizations?',
                'How are you handling error boundaries?',
                'The database schema seems well thought out.',
                'Great separation of concerns in the codebase.',
            ],
            'suggestions' => [
                'Maybe consider adding dark mode support?',
                'A mobile app version would be awesome!',
                'Have you thought about adding social login?',
                'A search feature would be really useful.',
                'Some unit tests would be a great addition.',
                'Documentation would help other developers.',
                'Consider adding rate limiting for the API.',
            ]
        ];

        $type = fake()->randomElement(array_keys($commentTypes));
        $body = fake()->randomElement($commentTypes[$type]);
        
        // Sometimes add a longer, more detailed comment
        if (fake()->boolean(30)) {
            $additionalComments = [
                ' The implementation looks solid and well-thought-out.',
                ' Have you considered adding unit tests for better coverage?',
                ' The user interface is clean and intuitive.',
                ' This would be perfect for production use.',
                ' Great attention to detail in the documentation.',
                ' The performance optimization is impressive.',
                ' Would love to see more features like this.',
                ' The code structure follows best practices nicely.',
                ' This addresses a real need in the development community.',
                ' The responsive design works beautifully across devices.',
            ];
            $body .= fake()->randomElement($additionalComments);
        }

        $createdAt = fake()->dateTimeBetween('-3 months', 'now');

        return [
            'user_id' => User::factory(),
            'project_id' => Project::factory(),
            'body' => $body,
            'created_at' => $createdAt,
            'updated_at' => fake()->boolean(20) ? fake()->dateTimeBetween($createdAt, 'now') : $createdAt,
        ];
    }

    /**
     * Create a detailed technical comment.
     */
    public function technical(): static
    {
        $technicalComments = [
            'Excellent code architecture! I particularly like how you\'ve implemented the repository pattern here. The separation between the service layer and data access is clean. Have you considered adding caching to improve performance for frequently accessed data?',
            'The state management approach is solid. Using Redux/Vuex pattern effectively. One suggestion: you might want to consider implementing middleware for handling async operations more elegantly. Overall, great work on maintaining predictable state flow.',
            'Really impressed with the test coverage! Unit tests are comprehensive and integration tests cover the main user flows. Have you experimented with snapshot testing for the UI components? It could catch unexpected visual regressions.',
            'The database design is well normalized. The foreign key relationships are logical and the indexing strategy looks good for performance. One question: how are you handling database migrations in production?',
        ];

        return $this->state(fn (array $attributes) => [
            'body' => fake()->randomElement($technicalComments),
        ]);
    }

    /**
     * Create a short, positive feedback comment.
     */
    public function positive(): static
    {
        $positiveComments = [
            'Awesome work! 🔥',
            'This is exactly what I was looking for!',
            'Incredible attention to detail.',
            'Beautiful design and smooth functionality.',
            'You\'ve outdone yourself with this one!',
            'Bookmarking this for future reference.',
            'This deserves way more attention!',
        ];

        return $this->state(fn (array $attributes) => [
            'body' => fake()->randomElement($positiveComments),
        ]);
    }

    /**
     * Create a question-based comment.
     */
    public function question(): static
    {
        $questionComments = [
            'What framework did you use for the frontend? The performance is really smooth.',
            'Is there a live demo available? Would love to try it out myself.',
            'How long did it take you to build this? The scope seems quite extensive.',
            'Are you planning to open source this? The community would benefit greatly.',
            'What\'s your deployment strategy? Docker, traditional hosting, or cloud-native?',
            'Have you considered adding internationalization support?',
        ];

        return $this->state(fn (array $attributes) => [
            'body' => fake()->randomElement($questionComments),
        ]);
    }

    /**
     * Create a recent comment.
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