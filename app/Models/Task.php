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
        'user_id',
        'due_date',
        'estimated_hours',
        'priority',
        'group',
        'order',
        'labels'
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'due_date' => 'datetime',
        'labels' => 'array',
    ];

    const PRIORITY_LOW = 0;
    const PRIORITY_MEDIUM = 1;
    const PRIORITY_HIGH = 2;

    public static function priorities()
    {
        return [
            self::PRIORITY_LOW => 'Low',
            self::PRIORITY_MEDIUM => 'Medium',
            self::PRIORITY_HIGH => 'High',
        ];
    }

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

    // Sorting scopes
    public function scopeOrderByPriority($query)
    {
        return $query->orderBy('priority', 'desc');
    }

    public function scopeOrderByDueDate($query)
    {
        return $query->orderBy('due_date');
    }

    public function scopeOrderByCustom($query)
    {
        return $query->orderBy('order');
    }

    // Filtering scopes
    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeByGroup($query, $group)
    {
        return $query->where('group', $group);
    }

    public function scopeByLabel($query, $label)
    {
        return $query->where('labels', 'like', "%$label%");
    }

    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', now())
                    ->where('status', '!=', 'done');
    }

    public function scopeDueToday($query)
    {
        return $query->whereDate('due_date', now());
    }

    public function scopeDueThisWeek($query)
    {
        return $query->whereBetween('due_date', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }

    // Task status helper methods
    public function markAsDone()
    {
        $this->update(['status' => 'done']);
    }

    public function markAsInProgress()
    {
        $this->update(['status' => 'in_progress']);
    }

    public function markAsTodo()
    {
        $this->update(['status' => 'todo']);
    }

    // Priority helper methods
    public function setPriority($level)
    {
        if (array_key_exists($level, self::priorities())) {
            $this->update(['priority' => $level]);
        }
    }

    public function getPriorityLabel()
    {
        return self::priorities()[$this->priority] ?? 'Unknown';
    }

    // Labels helper methods
    public function addLabel($label)
    {
        $labels = $this->labels ?? [];
        if (!in_array($label, $labels)) {
            $labels[] = $label;
            $this->update(['labels' => $labels]);
        }
    }

    public function removeLabel($label)
    {
        $labels = $this->labels ?? [];
        $labels = array_diff($labels, [$label]);
        $this->update(['labels' => array_values($labels)]);
    }

    // Task organization helper methods
    public function setGroup($group)
    {
        $this->update(['group' => $group]);
    }

    public function setOrder($order)
    {
        $this->update(['order' => $order]);
    }
}
