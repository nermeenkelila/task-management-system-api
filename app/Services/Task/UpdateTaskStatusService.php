<?php

namespace App\Services\Task;

use App\Models\Task;


class UpdateTaskStatusService
{
    public function execute(array $validated, Task $task): Task
    {
        $task->update($validated);

        return $task->load('dependencies');
    }

}