<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\TaskDetailsResource;
use App\Services\Task\UpdateTaskStatusService;
use App\Http\Requests\Task\UpdateTaskStatusRequest;

class UpdateTaskStatusController extends BaseController
{
    protected $service = null;

    public function __construct(
        UpdateTaskStatusService $service

    ) {
        $this->service = $service;
    }
     public function __invoke(UpdateTaskStatusRequest $request, Task $task): JsonResponse
    {
        $validated = $request->validated();
        $task = $this->service->execute($validated, $task);
        return $this->sendSuccessResponse( new TaskDetailsResource($task), 'Status updated successfully.');
    }
}
