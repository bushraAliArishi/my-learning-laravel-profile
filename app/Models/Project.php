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
 * In Laravel’s Eloquent, you control which model properties can be set via
 * “mass assignment” (e.g. Model::create($array) or Model::fill($array))
 * by using either the $fillable or $guarded property.
 *
 * protected $fillable = ['col1', 'col2', …];
 *     • A “white‐list” approach.
 *     • Only the columns listed here may be bulk‐assigned.
 *     • Any key in the input array not in $fillable will be ignored.
 *     • Use when you want tight, explicit control over which fields
 *       can be set by external input.
 *
 * protected $fillable;
 *     • Declares the property but leaves it uninitialized (null).
 *     • Behaves as if no attributes have been marked as fillable.
 *     • In practice, avoid leaving it unset—either define it or remove it.
 *
 * protected $guarded = [];
 *     • A “black‐list” approach.
 *     • By setting $guarded to an empty array, **all** columns are mass‐assignable.
 *     • Use with caution: you’re trusting that validation elsewhere
 *       prevents unwanted input.
 *
 * protected $guarded;
 *     • Declares the property but leaves it uninitialized (null).
 *     • Behaves as if **every** column is guarded, so **none** can be
 *       mass‐assigned—unless you explicitly set $fillable instead.
 *     • Rarely used; better to either define your guard list or remove it.
 *
 * —— Choosing between $fillable and $guarded ——  
 * • Pick **one** strategy per model.  
 * • Default recommendation: use $fillable with explicit fields.  
 * • Only use $guarded = [] if you truly want to allow mass‐assignment
 *   of every column and have other safeguards in place.  
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
