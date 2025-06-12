<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'features',
        'status',
        'idea_id',
        'user_id'
    ];

    protected static function booted()
    {
        static::creating(function ($project) {
            if (!$project->user_id && auth()->id()) {
                $project->user_id = auth()->id();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeForUser($query)
    {
        return $query->where('user_id', auth()->id());
    }

    public function idea()
    {
        return $this->belongsTo(Idea::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    protected $casts = [
        'features' => 'array',
    ];
}
