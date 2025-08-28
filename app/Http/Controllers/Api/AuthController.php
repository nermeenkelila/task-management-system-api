<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\RegisterService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
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
        $input = $request->validated();
        $data = $this->service->execute($input);
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
        $data['user'] =  $user;
        return $this->sendSuccessResponse($data, 'User login successfully.');
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
