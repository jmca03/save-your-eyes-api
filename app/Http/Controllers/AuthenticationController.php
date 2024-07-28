<?php

namespace App\Http\Controllers;

use App\Contracts\AuthenticationRepositoryInterface;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    /**
     * Create new instance of class
     *
     * @param \App\Contracts\AuthenticationRepositoryInterface $repository ;
     */
    public function __construct(protected AuthenticationRepositoryInterface $repository)
    {
        //
    }

    /**
     * Handles user's login
     *
     * @param \App\Http\Requests\LoginRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->repository->login($request->validated());
    }

    /**
     * Handle user's logout
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): JsonResponse
    {
        return $this->repository->logout();
    }

    /**
     * Handle user registration
     *
     * @param \App\Http\Requests\RegisterUserRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterUserRequest $request): JsonResponse
    {
        return $this->repository->register($request->validated());
    }
}
