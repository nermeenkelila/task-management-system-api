<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\TaskResource;
use App\Services\Task\AssignTaskService;
use App\Http\Requests\Task\AssignTaskRequest;

class AssignTaskController extends BaseController
{
    protected $service = null;

    public function __construct(
        AssignTaskService $service

    ) {
        $this->service = $service;
    }
     public function __invoke(AssignTaskRequest $request, Task $task): JsonResponse
    {
        $validated = $request->validated();
        $task = $this->service->execute($validated, $task);
        return $this->sendSuccessResponse( new TaskResource($task), 'Task assigned successfully.');
    }
}
