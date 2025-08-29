<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\TaskResource;
use App\Services\Task\StoreTaskService;
use App\Services\Task\RetrieveTasksService;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\TaskFilterRequest;

class TaskController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(TaskFilterRequest $request, RetrieveTasksService $service)
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
        return $this->sendSuccessResponse( new TaskResource($task), 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
