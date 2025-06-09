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
        'is_ready'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}

