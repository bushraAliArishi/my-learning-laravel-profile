<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Experience;
use App\Models\Tool;

class ExperienceToolTableSeeder extends Seeder
{
    public function run()
    {
        $map = [
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

        foreach ($map as $slug => $toolNames) {
            $exp = Experience::where('slug', $slug)->first();
            if ($exp) {
                $ids = Tool::whereIn('name', $toolNames)->pluck('id')->toArray();
                $exp->tools()->syncWithoutDetaching($ids);
            }
        }
    }
}
