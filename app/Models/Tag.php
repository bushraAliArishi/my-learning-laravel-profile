<?php
// app/Models/Tag.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'color_hex',
    ];

    /**
     * The projects that belong to this tag (many-to-many).
     */
    public function projects()
    {
        return $this->belongsToMany(
            Project::class,   // Related model
            'project_tag',    // Pivot table name
            'tag_id',         // This model's foreign key on pivot
            'project_id'      // Other model's foreign key on pivot
        )->withTimestamps();
    }
}
