<?php
// app/Models/Project.php

namespace App\Models;

use Illuminate\Support\Str;

class Project
{
    public static function all(): array
    {
        return [
            [
                'slug'        => 'focus-booking-management',
                'title'       => 'Focus – Booking Management System',
                'link'        => 'https://github.com/bushraAliArishi/graduate-project-Focus',
                'image'       => asset('images/logos/LOGO.svg'),
                'description' => 'A comprehensive backend system for managing booking workflows between photographers and editors, built with Java and Spring Boot.',
                'type'        => 'Backend Development',
                'tech'        => ['Java', 'Spring Boot', 'MySQL', 'Postman'],
            ],
            [
                'slug'        => 'bani-equipment-marketplace',
                'title'       => 'Bani – Construction Equipment Marketplace',
                'link'        => 'https://banibuilder.com/',
                'image'       => asset('images/logos/BANI.svg'),
                'description' => 'A no-code marketplace platform for construction equipment rentals with advanced booking and payment systems.',
                'type'        => 'No-Code Development',
                'tech'        => ['Bubble.io', 'SEO', 'Payment Integration'],
            ],
            [
                'slug'        => 'ibe-x-ai-platform',
                'title'       => 'i-be X – AI Platform',
                'link'        => 'https://i-be-x.com/',
                'image'       => asset('images/logos/i-be X.svg'),
                'description' => 'Youth-centric AI platform offering smart tools, chatbots, and competitions with dynamic prompt management.',
                'type'        => 'AI Platform Development',
                'tech'        => ['Bubble.io', 'AI Integration', 'User Management'],
            ],
            [
                'slug'        => 'ibe-hub-internal-system',
                'title'       => 'i-be Hub – Internal Management System',
                'link'        => 'https://ibehub.com/',
                'image'       => asset('images/logos/logo-2.svg'),
                'description' => 'Centralized hub for internal task and communication management with role-based dashboards.',
                'type'        => 'Internal Systems',
                'tech'        => ['Bubble.io', 'Workflow Design', 'Documentation'],
            ],
            [
                'slug'        => 'infnt-project-manager',
                'title'       => 'INFNT – Project Manager',
                'link'        => 'http://infntsolutions.com',
                'image'       => asset('images/logos/INFNT.svg'),
                'description' => 'A dual-purpose platform for freelancers and event planners offering listings, event creation, and integrated bookings.',
                'type'        => 'Project Management & No-Code',
                'tech'        => ['Bubble.io', 'QA Testing', 'Google Workspace Admin'],
            ],
        ];
    }

    public static function hostLogo(string $url): string
    {
        $host = parse_url($url, PHP_URL_HOST) ?: '';

        $map = [
            'github.com'         => 'github-icon-1-logo-svgrepo-com.svg',
            'banibuilder.com'    => 'bani.svg',
            'i-be-x.com'         => 'i-be X.svg',
            'ibehub.com'         => 'logo-2.svg',
            'infntsolutions.com' => 'INFNT.svg',
        ];

        foreach ($map as $domain => $file) {
            if (Str::contains($host, $domain)) {
                return $file;
            }
        }

        return 'default-logo.png';
    }

    public static function techIcon(string $tech): string
    {
        $map = [
            'Java'                    => 'java-4-logo-svgrepo-com.svg',
            'Spring Boot'             => 'spring-svgrepo-com.svg',
            'MySQL'                   => 'mysql-logo-svgrepo-com.svg',
            'Postman'                 => 'postman-icon-svgrepo-com.svg',
            'Bubble.io'               => 'Bubble_Logo_no_code.svg',
            'SEO'                     => 'google-analytics-1-logo-svgrepo-com.svg',
            'Payment Integration'     => 'stripe-logo.svg',
            'AI Integration'          => 'python-svgrepo-com.svg',
            'User Management'         => 'lucidchart.svg',
            'Workflow Design'         => 'flutter-svgrepo-com.svg',
            'Documentation'           => 'notion-logo-svgrepo-com.svg',
            'QA Testing'              => 'prettier-svgrepo-com.svg',
            'Google Workspace Admin'  => 'google-workspace-logo.svg',
        ];

        return $map[$tech] ?? 'default-logo.png';
    }
}
