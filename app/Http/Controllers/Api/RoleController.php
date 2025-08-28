<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\RoleResource;
use Illuminate\Http\JsonResponse;
use App\Repositories\RoleRepository;

class RoleController extends BaseController
{

    protected $repository;

    public function __construct(
        RoleRepository $repository,
    ) {
        $this->repository = $repository;
    }

    public function index(): JsonResponse
    {
        $roles = $this->repository->get();
        return $this->sendSuccessResponse(RoleResource::collection($roles), 'Roles retrieved successfully.');
    }
}
