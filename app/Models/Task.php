<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'assignee_id',
        'created_by',
        'due_date'
    ];

     protected $casts = [
        'due_date' => 'date',
    ];

    protected $with = ['assignee'];

     public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeFilterByStatus(Builder $query, $status)
    {
        if ($status) {
            $query->where('status', $status);
        }
    }

    public function scopeFilterByAssignee(Builder $query, int $userId)
    {
        if ($userId) {
            $query->where('assignee_id', $userId);
        }
    }

    public function scopeFilterByDueDateRange(Builder $query, $startDate, $endDate)
    {
        if ($startDate) {
            $query->where('due_date', '>=', $startDate);
        }
        
        if ($endDate) {
            $query->where('due_date', '<=', $endDate);
        }
    }
}
