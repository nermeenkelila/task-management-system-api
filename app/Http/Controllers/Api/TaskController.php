<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\Task\StoreTaskService;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Resources\TaskResource;

class TaskController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
