<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse;

interface AuthenticationRepositoryInterface
{
    /**
     * Handle user login.
     *
     * @param array $payload
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException
     */
    public function login(array $payload): JsonResponse;

    /**
     * Handle user logout.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): JsonResponse;

    /**
     * Handles registration
     *
     * @param array $payload
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(array $payload): JsonResponse;
}
