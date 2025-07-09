<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\ProjectTag;

class ProjectTagsTableSeeder extends Seeder
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

        foreach ($map as $slug => $tags) {
            $proj = Project::where('slug', $slug)->first();
            if ($proj) {
                foreach ($tags as $tag) {
                    ProjectTag::updateOrCreate(
                        ['project_id' => $proj->id, 'tag' => $tag],
                        ['color_hex' => '#000000']
                    );
                }
            }
        }
    }
}
