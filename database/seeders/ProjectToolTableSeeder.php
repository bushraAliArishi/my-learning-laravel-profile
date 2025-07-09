<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Tool;

class ProjectToolTableSeeder extends Seeder
{
    public function run()
    {
        $map = [
            'focus-booking-management'    => ['Java','Spring Boot','MySQL','Postman'],
            'bani-equipment-marketplace'  => ['Bubble.io','SEO','Payment Integration'],
            'ibe-x-ai-platform'           => ['Bubble.io','AI Integration','User Management'],
            'ibe-hub-internal-system'     => ['Bubble.io','Workflow Design','Documentation'],
            'infnt-project-manager'       => ['Bubble.io','QA Testing','Google Workspace Admin'],
        ];

        foreach ($map as $slug => $techs) {
            $proj = Project::where('slug', $slug)->first();
            if ($proj) {
                $ids = Tool::whereIn('name', $techs)->pluck('id')->toArray();
                $proj->tools()->syncWithoutDetaching($ids);
            }
        }
    }
}
