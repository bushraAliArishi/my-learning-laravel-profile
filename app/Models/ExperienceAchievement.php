<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;  // ← استوردنا الـ trait
use Illuminate\Database\Eloquent\Model;

class ExperienceAchievement extends Model
{
    use HasFactory;   // ← ضفّينا الـ trait

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'experience_achievements';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'experience_id',
        'description',
    ];

    /**
     * Get the experience that owns this achievement.
     */
    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }
}
