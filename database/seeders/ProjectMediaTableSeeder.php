<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\ProjectMedia;

class ProjectMediaTableSeeder extends Seeder
{
    public function run()
    {
        $map = [
            'focus-booking-management'    => ['url'=>'images/logos/LOGO.svg','type'=>'image'],
            'bani-equipment-marketplace'  => ['url'=>'images/logos/BANI.svg','type'=>'image'],
            'ibe-x-ai-platform'           => ['url'=>'images/logos/i-be X.svg','type'=>'image'],
            'ibe-hub-internal-system'     => ['url'=>'images/logos/logo-2.svg','type'=>'image'],
            'infnt-project-manager'       => ['url'=>'images/logos/INFNT.svg','type'=>'image'],
        ];

        foreach ($map as $slug => $m) {
            $proj = Project::where('slug', $slug)->first();
            if ($proj) {
                $proj->media()->updateOrCreate(
                    ['project_id' => $proj->id, 'media_url' => $m['url']],
                    ['media_type' => $m['type']]
                );
            }
        }
    }
}
