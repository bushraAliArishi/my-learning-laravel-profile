<?php
// app/Models/Project.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Tag;
use App\Models\Tool;
use App\Models\ProjectMedia;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'slug',
        'title',
        'link',
        'description',
        'type',
    ];

    /**
     * Projects ⇄ Tags (many-to-many).
     */
    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'project_tag',
            'project_id',
            'tag_id'
        )->withTimestamps();
    }

    /**
     * Get the media (images/videos) for this project.
     */
    public function media()
    {
        return $this->hasMany(ProjectMedia::class);

    }

    /**
     * The tools that belong to this project (many-to-many).
     */
    public function tools()
    {
        return $this->belongsToMany(
            Tool::class,
            'project_tool',
            'project_id',
            'tool_id'
        )->withTimestamps();
    }

    /**
     * Return a host-specific logo filename based on the given URL.
     */
    public static function hostLogo(string $url): string
    {
        $host = parse_url($url, PHP_URL_HOST) ?: '';

        $map = [
            'github.com'         => 'github-icon-1-logo-svgrepo-com.svg',
            'banibuilder.com'    => 'bani.svg',
            'i-be-x.com'         => 'i-be X.svg',
            'ibehub.com'         => 'logo-2.svg',
            'infntsolutions.com' => 'INFNT.svg',
        ];

        foreach ($map as $domain => $file) {
            if (Str::contains($host, $domain)) {
                return $file;
            }
        }

        return 'default-logo.png';
    }

    /**
     * Return a tech-specific icon filename based on the given tech name.
     */
    public static function techIcon(string $tech): string
    {
        $map = [
            'Java'                   => 'java-4-logo-svgrepo-com.svg',
            'Spring Boot'            => 'spring-svgrepo-com.svg',
            'MySQL'                  => 'mysql-logo-svgrepo-com.svg',
            'Postman'                => 'postman-icon-svgrepo-com.svg',
            'Bubble.io'              => 'Bubble_Logo_no_code.svg',
            'SEO'                    => 'google-analytics-1-logo-svgrepo-com.svg',
            'Payment Integration'    => 'stripe-logo.svg',
            'AI Integration'         => 'python-svgrepo-com.svg',
            'User Management'        => 'lucidchart.svg',
            'Workflow Design'        => 'flutter-svgrepo-com.svg',
            'Documentation'          => 'notion-logo-svgrepo-com.svg',
            'QA Testing'             => 'prettier-svgrepo-com.svg',
            'Google Workspace Admin' => 'google-workspace-logo.svg',
        ];

        return $map[$tech] ?? 'default-logo.png';
    }
}
