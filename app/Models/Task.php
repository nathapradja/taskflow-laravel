<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'project_id',
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'attachment',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}