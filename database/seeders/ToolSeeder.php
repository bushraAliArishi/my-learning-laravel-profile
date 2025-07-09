<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tool;

class ToolSeeder extends Seeder
{
    public function run()
    {
        $tools = [
            // من الخبرات
            ['name'=>'Google Admin Console', 'logo'=>'images/logos/google-icon-logo-svgrepo-com.svg'],
            ['name'=>'Bubble.io',            'logo'=>'images/logos/Bubble_Logo_no_code.svg'],
            ['name'=>'App Store Connect',    'logo'=>'images/logos/App_Store_(iOS).svg'],
            ['name'=>'Google Play Console',  'logo'=>'images/logos/google-play-svgrepo-com.svg'],
            ['name'=>'Zoom',                 'logo'=>'images/logos/zoom-svg-logo_logoshape.com.svg'],
            ['name'=>'Microsoft 365',        'logo'=>'images/logos/Microsoft_365_(2022).svg'],
            ['name'=>'Notion',               'logo'=>'images/logos/notion-logo-svgrepo-com.svg'],
            ['name'=>'ClickUp',              'logo'=>'images/logos/trello-logo-svgrepo-com.svg'],
            ['name'=>'Lucidchart',           'logo'=>'images/logos/lucidchart.svg'],

            // من المشاريع (tech)
            ['name'=>'Java',                   'logo'=>'images/logos/java-4-logo-svgrepo-com.svg'],
            ['name'=>'Spring Boot',            'logo'=>'images/logos/spring-svgrepo-com.svg'],
            ['name'=>'MySQL',                  'logo'=>'images/logos/mysql-logo-svgrepo-com.svg'],
            ['name'=>'Postman',                'logo'=>'images/logos/postman-icon-svgrepo-com.svg'],
            ['name'=>'SEO',                    'logo'=>'images/logos/google-analytics-1-logo-svgrepo-com.svg'],
            ['name'=>'Payment Integration',    'logo'=>'images/logos/stripe-logo.svg'],
            ['name'=>'AI Integration',         'logo'=>'images/logos/python-svgrepo-com.svg'],
            ['name'=>'User Management',        'logo'=>'images/logos/lucidchart.svg'],
            ['name'=>'Workflow Design',        'logo'=>'images/logos/flutter-svgrepo-com.svg'],
            ['name'=>'Documentation',          'logo'=>'images/logos/notion-logo-svgrepo-com.svg'],
            ['name'=>'QA Testing',             'logo'=>'images/logos/prettier-svgrepo-com.svg'],
            ['name'=>'Google Workspace Admin', 'logo'=>'images/logos/google-workspace-logo.svg'],
        ];

        foreach ($tools as $t) {
            Tool::updateOrCreate(
                ['name' => $t['name']],
                ['logo' => $t['logo']]
            );
        }
    }
}
