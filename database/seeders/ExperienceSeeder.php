<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Experience;
use App\Models\ExperienceSkill;
use App\Models\ExperienceAchievement;
use App\Models\Tool;

class ExperienceSeeder extends Seeder
{
    public function run()
    {
         $experiences = [
            'senior-technical-developer' => [
                'title'=>'Senior Technical Developer',
                'company'=>'i-be',
                'period'=>'Jan 2024 – Jul 2025',
                'details'=>'Primary operator of Google Admin Console for 1,000+ users—managed accounts, groups, and archiving; authored guides, led trainings, and spearheaded no-code medical initiatives.',
            ],
            'technical-specialist' => [
                'title'=>'Technical Specialist',
                'company'=>'i-be Group',
                'period'=>'Aug 2022 – Jan 2024',
                'details'=>'Managed internal platform builds in Bubble.io, customized interfaces, supervised interns, and coordinated stakeholder meetings for alignment.',
            ],
            'jiff-trainee' => [
                'title'=>'No-Code Development Trainee',
                'company'=>'JIFF Technology',
                'period'=>'Jun 2022 – Aug 2023',
                'details'=>'Completed immersive Bubble.io training covering backend logic, responsive design, and automation workflows for production readiness.',
            ],
            'call-center-agent' => [
                'title'=>'Call Center Agent',
                'company'=>'Al Khuzama Trading Co.',
                'period'=>'Jun 2021 – May 2022',
                'details'=>'Handled high-volume customer inquiries, resolved technical issues, and created self-help materials to improve support efficiency.',
            ],
            'technical-intern' => [
                'title'=>'Technical Intern',
                'company'=>'Ministry of Communications & IT',
                'period'=>'Jan 2021 – Jun 2021',
                'details'=>'Assisted in digital transformation initiatives: cloud labs, automation training, and internal IT process documentation.',
            ],
        ];

         $skillsMap = [
            'senior-technical-developer' => [
                'Advanced Google Workspace administration',
                'Device account integration & policy configuration',
                'App deployment & compliance',
                'Technical troubleshooting & resolution',
                'Team training & mentorship',
                'No-code project leadership',
            ],
            'technical-specialist' => [
                'No-code backend & UI development',
                'Custom front-end scripting (HTML/JS)',
                'Process documentation & mapping',
                'Intern training & team leadership',
                'Stakeholder coordination',
                'Security compliance enforcement',
            ],
            'jiff-trainee' => [
                'Bubble.io application prototyping',
                'Workflow automation design',
                'Responsive UI development',
                'Conditional logic implementation',
            ],
            'call-center-agent' => [
                'High-volume customer support',
                'Technical issue resolution',
                'Knowledge base creation',
            ],
            'technical-intern' => [
                'Digital transformation frameworks',
                'Cloud computing basics',
                'Automation tool familiarization',
                'IT process documentation',
            ],
        ];

         $achievementsMap = [
            'senior-technical-developer' => [
                'Onboarded & offboarded 1,000+ users via Google Admin Console; configured security policies & archived data.',
                'Led device provisioning aligned with workspace compliance requirements.',
                'Published internal apps on App Store & Google Play; resolved rejections and updates.',
            ],
            'technical-specialist' => [
                'Designed & optimized backend workflows and UIs in Bubble.io.',
                'Developed custom HTML/JS components for dynamic user experiences.',
                'Documented device inventories & produced usage guides in Notion.',
            ],
            'jiff-trainee' => [
                'Built end-to-end app prototypes with Bubble.io.',
                'Implemented complex conditional workflows and data bindings.',
                'Crafted responsive UI following UX best practices.',
            ],
            'call-center-agent' => [
                'Resolved 80+ daily technical queries via phone & email.',
                'Authored detailed FAQs and step-by-step user guides.',
            ],
            'technical-intern' => [
                'Participated in cloud & automation workshops.',
                'Documented IT workflows and best practices.',
            ],
        ];

         $toolsMap = [
            'senior-technical-developer' => [
                'Google Admin Console','Bubble.io','App Store Connect',
                'Google Play Console','Zoom','Microsoft 365',
                'Notion','ClickUp','Lucidchart',
            ],
            'technical-specialist' => [
                'Bubble.io','HTML5','JavaScript','Android Studio','Notion',
            ],
            'jiff-trainee' => ['Bubble.io'],
            'call-center-agent' => ['Zendesk','Outlook','VoIP System'],
            'technical-intern' => ['Google Cloud','Internal Tools','Lab Environments'],
        ];

        foreach ($experiences as $slug => $data) {
             $exp = Experience::updateOrCreate(
                ['slug' => $slug],
                [
                    'title'   => $data['title'],
                    'company' => $data['company'],
                    'period'  => $data['period'],
                    'details' => $data['details'],
                ]
            );

             foreach ($skillsMap[$slug] as $skill) {
                ExperienceSkill::updateOrCreate(
                    [
                        'experience_id' => $exp->id,
                        'skill_name'    => $skill,
                    ],
                    []
                );
            }

             foreach ($achievementsMap[$slug] as $text) {
                ExperienceAchievement::updateOrCreate(
                    [
                        'experience_id' => $exp->id,
                        'description'   => $text,
                    ],
                    []
                );
            }

             $ids = Tool::whereIn('name', $toolsMap[$slug])
                      ->pluck('id')
                      ->toArray();
            $exp->tools()->syncWithoutDetaching($ids);
        }
    }
}
