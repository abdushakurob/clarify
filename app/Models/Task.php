<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'project_id',
        'scheduled_at',
        'user_id'
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($task) {
            if (!$task->user_id && auth()->id()) {
                $task->user_id = auth()->id();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function scopeForUser($query)
    {
        return $query->where('user_id', auth()->id());
    }
}
