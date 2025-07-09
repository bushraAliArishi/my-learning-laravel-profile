<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectMedia extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_media';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'project_id',
        'media_url',
        'media_type',
    ];

    /**
     * Get the project that owns this media.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
