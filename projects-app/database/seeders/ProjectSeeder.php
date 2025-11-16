<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $projects = [
            [
                'title' => 'Project Alpha',
                'description' => 'Description for Project Alpha',
                'image_url' => 'https://via.placeholder.com/150',
            ],
            [
                'title' => 'Project Beta',
                'description' => 'Description for Project Beta',
                'image_url' => 'https://via.placeholder.com/150',
            ],
            [
                'title' => 'Project Gamma',
                'description' => 'Description for Project Gamma',
                'image_url' => 'https://via.placeholder.com/150',
            ],
            [
                'title' => 'Project Delta',
                'description' => 'Description for Project Delta',
                'image_url' => 'https://via.placeholder.com/150',
            ],
            [
                'title' => 'Project Epsilon',
                'description' => 'Description for Project Epsilon',
                'image_url' => 'https://via.placeholder.com/150',
            ],
            [
                'title' => 'Project Zeta',
                'description' => 'Description for Project Zeta',
                'image_url' => 'https://via.placeholder.com/150',
            ],
            [
                'title' => 'Project Eta',
                'description' => 'Description for Project Eta',
                'image_url' => 'https://via.placeholder.com/150',
            ],
            [
                'title' => 'Project Theta',
                'description' => 'Description for Project Theta',
                'image_url' => 'https://via.placeholder.com/150',
            ],
            [
                'title' => 'Project Iota',
                'description' => 'Description for Project Iota',
                'image_url' => 'https://via.placeholder.com/150',
            ],
            [
                'title' => 'Project Kappa',
                'description' => 'Description for Project Kappa',
                'image_url' => 'https://via.placeholder.com/150',
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
