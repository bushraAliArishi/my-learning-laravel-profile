<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'logo',
    ];

    /**
     * The experiences that use this tool (many-to-many).
     */
    public function experiences()
    {
        return $this->belongsToMany(
            Experience::class,
            'experience_tool',
            'tool_id',
            'experience_id'
        );
    }

    /**
     * The projects that use this tool (many-to-many).
     */
    public function projects()
    {
        return $this->belongsToMany(
            Project::class,
            'project_tool',
            'tool_id',
            'project_id'
        );
    }
}
