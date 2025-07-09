<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExperienceSkill extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'experience_skills';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'experience_id',
        'skill_name',
    ];

    /**
     * Get the experience that owns this skill.
     */
    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }
}
