<?php

namespace App\Services\Task;

use App\Enums\StatusEnum;
use App\Models\Task;
use App\Repositories\TaskRepository;


class UpdateTaskService
{
    protected $repository = null;

    public function __construct(
        TaskRepository $repository

    ) {
        $this->repository = $repository;
    }
    public function execute(array $validated, Task $task): Task
     {
        $task = $this->repository->update($task->id, $validated, true);
        if (isset($validated['dependencies'])) {
            $task->dependencies()->sync($validated['dependencies']);
        }

        return $task->load('dependencies');
    }

}