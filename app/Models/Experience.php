<?php

namespace App\Models;

use PhpParser\Node\Expr\Cast\String_;

class Experience
{
    /**
     * Return all experiences with their full data.
     *
     * @return array
     */
    public static function all(): array
    {
        return [

            // 1. Senior Technical Developer
            [
                'slug'        => 'senior-technical-developer',
                'title'       => 'Senior Technical Developer',
                'company'     => 'i-be',
                'period'      => 'Jan 2024 – Jul 2025',
                'skills'      => [
                    'Advanced Google Workspace administration',
                    'Device account integration & policy configuration',
                    'App deployment & compliance',
                    'Technical troubleshooting & resolution',
                    'Team training & mentorship',
                    'No-code project leadership',
                ],
                'tools'       => [
                    [ 'name' => 'Google Admin Console', 'logo' => 'images/logos/google-icon-logo-svgrepo-com.svg' ],
                    [ 'name' => 'Bubble.io',            'logo' => 'images/logos/Bubble_Logo_no_code.svg' ],
                    [ 'name' => 'App Store Connect',    'logo' => 'images/logos/App_Store_(iOS).svg' ],
                    [ 'name' => 'Google Play Console',  'logo' => 'images/logos/google-play-svgrepo-com.svg' ],
                    [ 'name' => 'Zoom',                 'logo' => 'images/logos/zoom-svg-logo_logoshape.com.svg' ],
                    [ 'name' => 'Microsoft 365',        'logo' => 'images/logos/Microsoft_365_(2022).svg' ],
                    [ 'name' => 'Notion',               'logo' => 'images/logos/notion-logo-svgrepo-com.svg' ],
                    [ 'name' => 'ClickUp',              'logo' => 'images/logos/trello-logo-svgrepo-com.svg' ], // example
                    [ 'name' => 'Lucidchart',           'logo' => 'images/logos/lucidchart.svg' ],
                ],
                'achievements'=> [
                    'Onboarded & offboarded 1,000+ users via Google Admin Console; configured security policies & archived data.',
                    'Led device provisioning aligned with workspace compliance requirements.',
                    'Published internal apps on App Store & Google Play; resolved rejections and updates.',
                ],
                'details'     => 'Primary operator of Google Admin Console for 1,000+ users—managed accounts, groups, and archiving; authored guides, led trainings, and spearheaded no-code medical initiatives.',
            ],

            // 2. Technical Specialist
            [
                'slug'        => 'technical-specialist',
                'title'       => 'Technical Specialist',
                'company'     => 'i-be Group',
                'period'      => 'Aug 2022 – Jan 2024',
                'skills'      => [
                    'No-code backend & UI development',
                    'Custom front-end scripting (HTML/JS)',
                    'Process documentation & mapping',
                    'Intern training & team leadership',
                    'Stakeholder coordination',
                    'Security compliance enforcement',
                ],
                'tools'       => [
                    [ 'name' => 'Bubble.io',      'logo' => 'images/logos/Bubble_Logo_no_code.svg' ],
                    [ 'name' => 'HTML5',          'logo' => 'images/logos/html-5-svgrepo-com.svg' ],
                    [ 'name' => 'JavaScript',     'logo' => 'images/logos/javascript-logo-svgrepo-com.svg' ],
                    [ 'name' => 'Android Studio', 'logo' => 'images/logos/android-logo-svgrepo-com.svg' ],
                    [ 'name' => 'Notion',         'logo' => 'images/logos/notion-logo-svgrepo-com.svg' ],
                ],
                'achievements'=> [
                    'Designed & optimized backend workflows and UIs in Bubble.io.',
                    'Developed custom HTML/JS components for dynamic user experiences.',
                    'Documented device inventories & produced usage guides in Notion.',
                ],
                'details'     => 'Managed internal platform builds in Bubble.io, customized interfaces, supervised interns, and coordinated stakeholder meetings for alignment.',
            ],

            // 3. No-Code Development Trainee
            [
                'slug'        => 'jiff-trainee',
                'title'       => 'No-Code Development Trainee',
                'company'     => 'JIFF Technology',
                'period'      => 'Jun 2022 – Aug 2023',
                'skills'      => [
                    'Bubble.io application prototyping',
                    'Workflow automation design',
                    'Responsive UI development',
                    'Conditional logic implementation',
                ],
                'tools'       => [
                    [ 'name' => 'Bubble.io', 'logo' => 'images/logos/Bubble_Logo_no_code.svg' ],
                ],
                'achievements'=> [
                    'Built end-to-end app prototypes with Bubble.io.',
                    'Implemented complex conditional workflows and data bindings.',
                    'Crafted responsive UI following UX best practices.',
                ],
                'details'     => 'Completed immersive Bubble.io training covering backend logic, responsive design, and automation workflows for production readiness.',
            ],

            // 4. Call Center Agent
            [
                'slug'        => 'call-center-agent',
                'title'       => 'Call Center Agent',
                'company'     => 'Al Khuzama Trading Co.',
                'period'      => 'Jun 2021 – May 2022',
                'skills'      => [
                    'High-volume customer support',
                    'Technical issue resolution',
                    'Knowledge base creation',
                ],
                'tools'       => [
                    [ 'name' => 'Zendesk',    'logo' => 'images/logos/discord-icon-svgrepo-com.svg' ], // substitute real zendesk.svg
                    [ 'name' => 'Outlook',    'logo' => 'images/logos/office-365-logo-svgrepo-com.svg' ],
                    [ 'name' => 'VoIP System','logo' => 'images/logos/voip.png' ],               // if you have it
                ],
                'achievements'=> [
                    'Resolved 80+ daily technical queries via phone & email.',
                    'Authored detailed FAQs and step-by-step user guides.',
                ],
                'details'     => 'Handled high-volume customer inquiries, resolved technical issues, and created self-help materials to improve support efficiency.',
            ],

            // 5. Technical Intern
            [
                'slug'        => 'technical-intern',
                'title'       => 'Technical Intern',
                'company'     => 'Ministry of Communications & IT',
                'period'      => 'Jan 2021 – Jun 2021',
                'skills'      => [
                    'Digital transformation frameworks',
                    'Cloud computing basics',
                    'Automation tool familiarization',
                    'IT process documentation',
                ],
                'tools'       => [
                    [ 'name' => 'Google Cloud',   'logo' => 'images/logos/firebase-1-logo-svgrepo-com.svg' ],
                    [ 'name' => 'Internal Tools', 'logo' => 'images/logos/icon-full-color.svg' ],   // placeholder
                    [ 'name' => 'Lab Environments','logo'=> 'images/logos/lab.png' ],             // placeholder
                ],
                'achievements'=> [
                    'Participated in cloud & automation workshops.',
                    'Documented IT workflows and best practices.',
                ],
                'details'     => 'Assisted in digital transformation initiatives: cloud labs, automation training, and internal IT process documentation.',
            ],

        ];
    }

    public static function find(String $slug):array{
        $exp=Arr[]



    }
}
