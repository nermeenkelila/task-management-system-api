<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\RegisterService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Api\BaseController as BaseController;

class AuthController extends BaseController
{
    protected $service = null;

    public function __construct(
        RegisterService $service

    ) {
        $this->service = $service;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $data = $this->service->execute($validated);
        return $this->sendSuccessResponse($data, 'User register successfully.');
    }
    /**
     * Login api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $input = $request->validated();
    
        if(!Auth::attempt(['email' => $input['email'], 'password' => $input['password']])){
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
         }

        $user = Auth::user(); 
        $data['token'] =  $user->createToken('auth-token')->plainTextToken; 
        $data['user'] =  new UserResource($user);
        return $this->sendSuccessResponse($data, 'User login successfully.');
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
