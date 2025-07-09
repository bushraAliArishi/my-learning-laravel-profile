<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $projects = [
            [
                'slug'        => 'focus-booking-management',
                'title'       => 'Focus – Booking Management System',
                'link'        => 'https://github.com/bushraAliArishi/graduate-project-Focus',
                'description' => 'A comprehensive backend system for managing booking workflows between photographers and editors, built with Java and Spring Boot.',
                'type'        => 'Backend Development',
            ],
            [
                'slug'        => 'bani-equipment-marketplace',
                'title'       => 'Bani – Construction Equipment Marketplace',
                'link'        => 'https://banibuilder.com/',
                'description' => 'A no-code marketplace platform for construction equipment rentals with advanced booking and payment systems.',
                'type'        => 'No-Code Development',
            ],
            [
                'slug'        => 'ibe-x-ai-platform',
                'title'       => 'i-be X – AI Platform',
                'link'        => 'https://i-be-x.com/',
                'description' => 'Youth-centric AI platform offering smart tools, chatbots, and competitions with dynamic prompt management.',
                'type'        => 'AI Platform Development',
            ],
            [
                'slug'        => 'ibe-hub-internal-system',
                'title'       => 'i-be Hub – Internal Management System',
                'link'        => 'https://ibehub.com/',
                'description' => 'Centralized hub for internal task and communication management with role-based dashboards.',
                'type'        => 'Internal Systems',
            ],
            [
                'slug'        => 'infnt-project-manager',
                'title'       => 'INFNT – Project Manager',
                'link'        => 'http://infntsolutions.com',
                'description' => 'A dual-purpose platform for freelancers and event planners offering listings, event creation, and integrated bookings.',
                'type'        => 'Project Management & No-Code',
            ],
        ];

        foreach ($projects as $p) {
            Project::updateOrCreate(
                ['slug' => $p['slug']],
                [
                    'title'       => $p['title'],
                    'link'        => $p['link'],
                    'description' => $p['description'],
                    'type'        => $p['type'],
                ]
            );
        }
    }
}
