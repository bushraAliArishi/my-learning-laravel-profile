<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;  // ← أضفّي هذا
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;  // ← وأضفّي هذا

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'slug',
        'title',
        'company',
        'period',
        'details',
        'start_date',
        'end_date',
    ];

    /**
     * Get the skills for this experience.
     */
    public function skills()
    {
        return $this->hasMany(ExperienceSkill::class);
    }

    /**
     * Get the achievements for this experience.
     */
    public function achievements()
    {
        return $this->hasMany(ExperienceAchievement::class);
    }

    /**
     * The tools that belong to this experience (many-to-many).
     */
    public function tools()
    {
        return $this->belongsToMany(
            Tool::class,
            'experience_tool',
            'experience_id',
            'tool_id'
        );
    }
}
