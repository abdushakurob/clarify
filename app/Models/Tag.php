<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'user_id'
    ];

    protected static function booted()
    {
        static::creating(function ($tag) {
            if (!$tag->user_id && auth()->id()) {
                $tag->user_id = auth()->id();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ideas()
    {
        return $this->belongsToMany(Idea::class);
    }

    public function scopeForUser($query)
    {
        return $query->where('user_id', auth()->id());
    }
}
