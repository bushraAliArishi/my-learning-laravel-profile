<?php
// database/seeders/ToolSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tool;

class ToolSeeder extends Seeder
{
    public function run(): void
    {
        $tools = [
            ['name'=>'Google Admin Console', 'logo'=>'images/logos/google-icon-logo-svgrepo-com.svg'],
            ['name'=>'Bubble.io',            'logo'=>'images/logos/Bubble_Logo_no_code.svg'],
            ['name'=>'App Store Connect',    'logo'=>'images/logos/App_Store_(iOS).svg'],
            ['name'=>'Google Play Console',  'logo'=>'images/logos/google-play-svgrepo-com.svg'],
            ['name'=>'Zoom',                 'logo'=>'images/logos/zoom-svg-logo_logoshape.com.svg'],
            ['name'=>'Microsoft 365',        'logo'=>'images/logos/Microsoft_365_(2022).svg'],
            ['name'=>'Notion',               'logo'=>'images/logos/notion-logo-svgrepo-com.svg'],
            ['name'=>'ClickUp',              'logo'=>'images/logos/trello-logo-svgrepo-com.svg'],
            ['name'=>'Lucidchart',           'logo'=>'images/logos/lucidchart.svg'],
            ['name'=>'HTML5',                'logo'=>'images/logos/html-5-svgrepo-com.svg'],
            ['name'=>'JavaScript',           'logo'=>'images/logos/javascript-logo-svgrepo-com.svg'],
            ['name'=>'Android Studio',       'logo'=>'images/logos/android-logo-svgrepo-com.svg'],
            ['name'=>'Zendesk',              'logo'=>'images/logos/discord-icon-svgrepo-com.svg'],
            ['name'=>'Outlook',              'logo'=>'images/logos/office-365-logo-svgrepo-com.svg'],
            ['name'=>'VoIP System',          'logo'=>'images/logos/voip.png'],
            ['name'=>'Google Cloud',         'logo'=>'images/logos/firebase-1-logo-svgrepo-com.svg'],
            ['name'=>'Internal Tools',       'logo'=>'images/logos/icon-full-color.svg'],
            ['name'=>'Lab Environments',     'logo'=>'images/logos/lab.png'],
        ];

        foreach ($tools as $t) {
            Tool::updateOrCreate(['name'=>$t['name']], ['logo'=>$t['logo']]);
        }
    }
}
