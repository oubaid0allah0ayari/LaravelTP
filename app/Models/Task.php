<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int                             $id
 * @property string                          $title
 * @property string|null                     $description
 * @property bool                            $is_completed
 * @property \Illuminate\Support\Carbon|null $due_date
 * @property int                             $priority
 * @property \Illuminate\Support\Carbon      $created_at
 * @property \Illuminate\Support\Carbon      $updated_at
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'is_completed',
        'due_date',
        'priority'
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'due_date'     => 'date',
        'priority'     => 'integer',
    ];

    // ============================================================
    // ACCESSORS (Step 2: Eloquent Avancé)
    // ============================================================

    // Returns human-readable priority label
    public function getPriorityLabelAttribute(): string
    {
        return ['Nulle','Basse','Normale','Moyenne','Haute','Critique'][$this->priority ?? 0];
    }

    // Returns CSS color classes for the priority badge
    public function getPriorityColorAttribute(): string
    {
        return [
            'bg-gray-100 text-gray-600',
            'bg-blue-100 text-blue-600',
            'bg-yellow-100 text-yellow-600',
            'bg-orange-100 text-orange-600',
            'bg-red-100 text-red-600',
            'bg-red-200 text-red-700',
        ][$this->priority ?? 0];
    }

    // Returns true if the task is overdue
    public function getIsOverdueAttribute(): bool
    {
        return $this->due_date && $this->due_date->isPast() && !$this->is_completed;
    }

    // ============================================================
    // SCOPES (Step 2: Eloquent Avancé)
    // ============================================================

    // Only pending (not completed) tasks
    public function scopePending($query)
    {
        return $query->where('is_completed', false);
    }

    // Only completed tasks
    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true);
    }

    // Filter by priority level (0-5)
    public function scopeByPriority($query, int $level)
    {
        return $query->where('priority', $level);
    }

    // Tasks due today
    public function scopeDueToday($query)
    {
        return $query->whereDate('due_date', today());
    }

    // Overdue tasks
    public function scopeOverdue($query)
    {
        return $query->where('is_completed', false)
                     ->where('due_date', '<', today());
    }
}