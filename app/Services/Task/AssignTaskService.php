<?php

namespace App\Services\Task;

use App\Models\Task;
use App\Repositories\TaskRepository;


class AssignTaskService
{
    protected $repository = null;

    public function __construct(
        TaskRepository $repository

    ) {
        $this->repository = $repository;
    }
    public function execute(array $validated, Task $task): Task
    {
        $task->assignee_id = $validated['assignee_id'];
        $task->save();
        return $task;
    }

}