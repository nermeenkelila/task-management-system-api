<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
class RegisterService
{
    protected $repository = null;

    public function __construct(
        UserRepository $repository

    ) {
        $this->repository = $repository;
    }
    public function execute(array $input): array
     {
        $input['password'] = bcrypt($input['password']);
        $user = $this->repository->create($input);
        $data['token'] =  $user->createToken('auth-token')->plainTextToken;
        $data['user'] =  new UserResource($user);
        return $data;
    }

}