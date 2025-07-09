<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Experience;

class ExperienceSeeder extends Seeder
{
    public function run()
    {
        $experiences = [
            [
                'slug'    => 'senior-technical-developer',
                'title'   => 'Senior Technical Developer',
                'company' => 'i-be',
                'period'  => 'Jan 2024 – Jul 2025',
                'details' => 'Primary operator of Google Admin Console for 1,000+ users—managed accounts, groups, and archiving; authored guides, led trainings, and spearheaded no-code medical initiatives.',
            ],
            [
                'slug'    => 'technical-specialist',
                'title'   => 'Technical Specialist',
                'company' => 'i-be Group',
                'period'  => 'Aug 2022 – Jan 2024',
                'details' => 'Managed internal platform builds in Bubble.io, customized interfaces, supervised interns, and coordinated stakeholder meetings for alignment.',
            ],
            [
                'slug'    => 'jiff-trainee',
                'title'   => 'No-Code Development Trainee',
                'company' => 'JIFF Technology',
                'period'  => 'Jun 2022 – Aug 2023',
                'details' => 'Completed immersive Bubble.io training covering backend logic, responsive design, and automation workflows for production readiness.',
            ],
            [
                'slug'    => 'call-center-agent',
                'title'   => 'Call Center Agent',
                'company' => 'Al Khuzama Trading Co.',
                'period'  => 'Jun 2021 – May 2022',
                'details' => 'Handled high-volume customer inquiries, resolved technical issues, and created self-help materials to improve support efficiency.',
            ],
            [
                'slug'    => 'technical-intern',
                'title'   => 'Technical Intern',
                'company' => 'Ministry of Communications & IT',
                'period'  => 'Jan 2021 – Jun 2021',
                'details' => 'Assisted in digital transformation initiatives: cloud labs, automation training, and internal IT process documentation.',
            ],
        ];

        foreach ($experiences as $e) {
            Experience::updateOrCreate(
                ['slug' => $e['slug']],
                [
                    'title'   => $e['title'],
                    'company' => $e['company'],
                    'period'  => $e['period'],
                    'details' => $e['details'],
                ]
            );
        }
    }
}
