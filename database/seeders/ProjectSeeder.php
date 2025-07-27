<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectMedia;
use App\Models\Tag;
use App\Models\Tool;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            'focus-booking-management' => [
                'title' => 'Focus – Booking Management System',
                'link' => 'https://github.com/bushraAliArishi/graduate-project-Focus',
                'description' => 'A comprehensive backend system for managing booking workflows between photographers and editors, built with Java and Spring Boot.',
                'type' => 'Backend Development',
            ],
            'bani-equipment-marketplace' => [
                'title' => 'Bani – Construction Equipment Marketplace',
                'link' => 'https://banibuilder.com/',
                'description' => 'A no-code marketplace platform for construction equipment rentals with advanced booking and payment systems.',
                'type' => 'No-Code Development',
            ],
            'ibe-x-ai-platform' => [
                'title' => 'i-be X – AI Platform',
                'link' => 'https://i-be-x.com/',
                'description' => 'Youth-centric AI platform offering smart tools, chatbots, and competitions with dynamic prompt management.',
                'type' => 'AI Platform Development',
            ],
            'ibe-hub-internal-system' => [
                'title' => 'i-be Hub – Internal Management System',
                'link' => 'https://ibehub.com/',
                'description' => 'Centralized hub for internal task and communication management with role-based dashboards.',
                'type' => 'Internal Systems',
            ],
            'infnt-project-manager' => [
                'title' => 'INFNT – Project Manager',
                'link' => 'http://infntsolutions.com',
                'description' => 'A dual-purpose platform for freelancers and event planners offering listings, event creation, and integrated bookings.',
                'type' => 'Project Management & No-Code',
            ],
        ];

        $mediaMap = [
            'focus-booking-management' => ['url' => 'images/logos/LOGO.svg', 'type' => 'image'],
            'bani-equipment-marketplace' => ['url' => 'images/logos/BANI.svg', 'type' => 'image'],
            'ibe-x-ai-platform' => ['url' => 'images/logos/i-be X.svg', 'type' => 'image'],
            'ibe-hub-internal-system' => ['url' => 'images/logos/logo-2.svg', 'type' => 'image'],
            'infnt-project-manager' => ['url' => 'images/logos/INFNT.svg', 'type' => 'image'],
        ];

        $tagsMap = [
            'focus-booking-management' => ['Java', 'Spring Boot', 'MySQL', 'Postman'],
            'bani-equipment-marketplace' => ['Bubble.io', 'SEO', 'Payment Integration'],
            'ibe-x-ai-platform' => ['Bubble.io', 'AI Integration', 'User Management'],
            'ibe-hub-internal-system' => ['Bubble.io', 'Workflow Design', 'Documentation'],
            'infnt-project-manager' => ['Bubble.io', 'QA Testing', 'Google Workspace Admin'],
        ];

        $toolsMap = $tagsMap;

        foreach ($projects as $slug => $data) {
            $proj = Project::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $data['title'],
                    'link' => $data['link'],
                    'description' => $data['description'],
                    'type' => $data['type'],
                ]
            );

            if (isset($mediaMap[$slug])) {
                ProjectMedia::updateOrCreate(
                    [
                        'project_id' => $proj->id,
                        'media_url' => $mediaMap[$slug]['url'],
                    ],
                    ['media_type' => $mediaMap[$slug]['type']]
                );
            }

            $tagIds = Tag::whereIn('name', $tagsMap[$slug])
                ->pluck('id')
                ->toArray();
            $proj->tags()->sync($tagIds);

            $toolIds = Tool::whereIn('name', $toolsMap[$slug])
                ->pluck('id')
                ->toArray();
            $proj->tools()->sync($toolIds);
        }
    }
}
