<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Idea extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'notes',
        'status',
        'problem',
        'audience',
        'possible_solution',
        'is_ready',
        'user_id'
    ];

    protected static function booted()
    {
        static::creating(function ($idea) {
            if (!$idea->user_id && auth()->id()) {
                $idea->user_id = auth()->id();
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

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    public function hasProject(){
        return $this->projects()->exists();
    }
}

