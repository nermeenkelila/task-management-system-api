<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\BaseRepository;

class TaskRepository extends BaseRepository
{
    public function __construct(Task $task) {
        parent::__construct($task);
    }

    public function getFilteredTasks(array $filters)
    {
        $query = $this->model->query();

        $query->filterByStatus($filters['status'] ?? null);
        $query->filterByAssignee($filters['assignee_id'] ?? 0);
        $query->filterByDueDateRange($filters['start_date'] ?? null, $filters['end_date'] ?? null);

        $query->orderBy("id","desc");
        return $query->paginate(10);
    }
    
}