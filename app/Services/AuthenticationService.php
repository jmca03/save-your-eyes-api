<?php

namespace App\Services;

use App\Contracts\ApiResponseInterface;
use App\Traits\ResponseFormatter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AuthenticationService implements ApiResponseInterface
{
    use ResponseFormatter;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle user login.
     *
     * @param array $payload
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException
     */
    public function login(array $payload): JsonResponse
    {
        if (auth()->attempt($payload)) {
            $user = auth()->user();

            return $this->jsonSuccessResponse(
                data   : [
                    'accessToken' => $user->createToken(config('app.name'))->accessToken,
                ],
                message: __('auth.login.success')
            );
        }

        throw new AccessDeniedHttpException(__('auth.failed'));
    }

    /**
     * Handle user logout.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return $this->jsonSuccessResponse(
            data: [],
            message: __('auth.logout.success')
        );
    }

    // Todo: Register
    // Todo: Email Verification
    // Todo: Oauth
}
