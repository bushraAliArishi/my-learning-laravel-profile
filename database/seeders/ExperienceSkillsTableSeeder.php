<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Experience;
use App\Models\ExperienceSkill;

class ExperienceSkillsTableSeeder extends Seeder
{
    public function run()
    {
        $map = [
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

        foreach ($map as $slug => $skills) {
            $exp = Experience::where('slug', $slug)->first();
            if ($exp) {
                foreach ($skills as $skill) {
                    ExperienceSkill::updateOrCreate(
                        [
                            'experience_id' => $exp->id,
                            'skill_name'    => $skill,
                        ],
                        []
                    );
                }
            }
        }
    }
}
