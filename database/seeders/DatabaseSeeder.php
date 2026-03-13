<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Project;
use App\Models\Skill;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name'     => 'Justine Batuhan',
            'email'    => 'admin@portfolio.com',
            'password' => Hash::make('password123'),
        ]);

        // Seed skills
        $skills = [
            ['name' => 'HTML5',       'category' => 'Frontend', 'level' => 90, 'sort_order' => 1],
            ['name' => 'CSS3',        'category' => 'Frontend', 'level' => 85, 'sort_order' => 2],
            ['name' => 'JavaScript',  'category' => 'Frontend', 'level' => 75, 'sort_order' => 3],
            ['name' => 'PHP',         'category' => 'Backend',  'level' => 80, 'sort_order' => 1],
            ['name' => 'Laravel',     'category' => 'Backend',  'level' => 75, 'sort_order' => 2],
            ['name' => 'MySQL',       'category' => 'Backend',  'level' => 70, 'sort_order' => 3],
            ['name' => 'Git',         'category' => 'Tools',    'level' => 70, 'sort_order' => 1],
            ['name' => 'VS Code',     'category' => 'Tools',    'level' => 90, 'sort_order' => 2],
            ['name' => 'Figma',       'category' => 'Tools',    'level' => 60, 'sort_order' => 3],
        ];
        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // Seed projects
        $projects = [
            [
                'title'       => 'School Portfolio Website',
                'description' => 'A full-stack portfolio website built with Laravel, PHP, MySQL, and custom CSS. Features an admin dashboard to manage projects and skills dynamically.',
                'tech_stack'  => 'Laravel, PHP, MySQL, HTML, CSS, JavaScript',
                'github_url'  => 'https://github.com/justinebatuhan/portfolio',
                'featured'    => true,
                'sort_order'  => 1,
            ],
            [
                'title'       => 'Student Grade Tracker',
                'description' => 'A web application to track student grades, compute GWA, and generate semester reports. Built as a class project for IT subjects.',
                'tech_stack'  => 'PHP, MySQL, HTML, CSS',
                'featured'    => true,
                'sort_order'  => 2,
            ],
            [
                'title'       => 'Library Management System',
                'description' => 'A simple library management system for borrowing and returning books, with admin and student roles.',
                'tech_stack'  => 'PHP, MySQL, Bootstrap',
                'featured'    => false,
                'sort_order'  => 3,
            ],
        ];
        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
