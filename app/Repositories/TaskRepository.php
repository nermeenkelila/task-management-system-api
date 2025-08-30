<?php

namespace App\Repositories;

use App\Enums\StatusEnum;
use App\Models\Task;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class TaskRepository extends BaseRepository
{
    public function __construct(Task $task) {
        parent::__construct($task);
    }

    public function getFilteredTasks(array $filters): Collection
    {
        $query = $this->model->query();

        $query->filterByStatus($filters['status'] ?? null);
        $query->filterByAssignee($filters['assignee_id'] ?? 0);
        $query->filterByDueDateRange($filters['start_date'] ?? null, $filters['end_date'] ?? null);

        $query->orderBy("id","desc");
        return $query->get();
    }

    public function getCountOfNonCompletedDependences(int $id)
    {
        return $this->model->where('id', $id)
            ->whereHas('dependencies', function (Builder $query) {
                $query->where('status', '!=', StatusEnum::COMPLETED->value);
            })->count();

    }
    
}