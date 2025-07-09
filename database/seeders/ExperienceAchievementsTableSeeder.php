<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Experience;
use App\Models\ExperienceAchievement;

class ExperienceAchievementsTableSeeder extends Seeder
{
    public function run()
    {
        $map = [
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

        foreach ($map as $slug => $achievements) {
            $exp = Experience::where('slug', $slug)->first();
            if ($exp) {
                foreach ($achievements as $text) {
                    ExperienceAchievement::updateOrCreate(
                        [
                            'experience_id' => $exp->id,
                            'description'   => $text,
                        ],
                        []
                    );
                }
            }
        }
    }
}
