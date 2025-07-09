<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'slug',
        'title',
        'link',
        'description',
        'type',
    ];

    /**
     * Get the media (images/videos) for this project.
     */
    public function media()
    {
        return $this->hasMany(ProjectMedia::class);
    }

    /**
     * Get the tags for this project.
     */
    public function tags()
    {
        return $this->hasMany(ProjectTag::class);
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
        );
    }

    /**
     * Return a host‐specific logo filename based on the given URL.
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
     * Return a tech‐specific icon filename based on the given tech name.
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
