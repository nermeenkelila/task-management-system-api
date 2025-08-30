<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\TaskResource;
use App\Services\Task\StoreTaskService;
use App\Services\Task\UpdateTaskService;
use App\Http\Resources\TaskDetailsResource;
use App\Services\Task\RetrieveTasksService;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\TaskFilterRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(TaskFilterRequest $request, RetrieveTasksService $service): JsonResponse
    {
       $validated = $request->validated();
       $tasks = $service->execute($validated);
       return $this->sendSuccessResponse(TaskResource::collection($tasks), 'Tasks retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request, StoreTaskService $service): JsonResponse
    {
        $validated = $request->validated();
        $task = $service->execute($validated);
        return $this->sendSuccessResponse( 
            new TaskDetailsResource($task), 
            'Task created successfully.', 
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): JsonResponse
    {
        $this->authorize('view', $task);
        return $this->sendSuccessResponse( new TaskDetailsResource($task->load('dependencies')), 'Task retieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task, UpdateTaskService $service): JsonResponse 
    {
        $validated = $request->validated();
        $task = $service->execute($validated, $task);
        return $this->sendSuccessResponse( 
            new TaskDetailsResource($task), 
            'Task Updated successfully.', 
            Response::HTTP_CREATED
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): JsonResponse
    {
        $this->authorize('delete', $task);
        $task->delete();

        return $this->sendSuccessResponse( 
            [], 
            "Task deleted successfully", 
            Response::HTTP_NO_CONTENT
        );
    }
}
