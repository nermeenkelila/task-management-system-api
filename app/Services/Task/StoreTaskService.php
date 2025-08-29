<?php

namespace App\Services\Task;

use App\Enums\StatusEnum;
use App\Models\Task;
use App\Repositories\TaskRepository;


class StoreTaskService
{
    protected $repository = null;

    public function __construct(
        TaskRepository $repository

    ) {
        $this->repository = $repository;
    }
    public function execute(array $validated): Task
     {
        $validated['created_by'] = auth()->id();
        $validated['status'] = StatusEnum::PENDING;
        $task = $this->repository->create($validated);
        if (isset($validated['dependencies'])) {
            $task->dependencies()->sync($validated['dependencies']);
        }

        return $task;
    }

}