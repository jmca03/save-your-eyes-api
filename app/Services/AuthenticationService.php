<?php

namespace App\Services;

use App\Contracts\ApiResponseInterface;
use App\Contracts\AuthenticationRepositoryInterface;
use App\Models\User;
use App\Traits\ResponseFormatter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthenticationService implements ApiResponseInterface, AuthenticationRepositoryInterface
{
    use ResponseFormatter;

    /**
     * Create a new class instance.
     *
     * @param \App\Models\User $user
     */
    public function __construct(protected User $user)
    {
    }

    /**
     * Handle user login.
     *
     * @param array $payload
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException
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

        throw new UnauthorizedHttpException(__('auth.failed'));
    }

    /**
     * Handle user logout.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->user()?->tokens()?->delete();
        return $this->jsonSuccessResponse(
            data: [],
            message: __('auth.logout.success')
        );
    }

    /**
     * Handles registration.
     *
     * @param array $payload
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(array $payload): JsonResponse
    {
        $user = $this->user->create($payload);
        auth()->login($user);


        return $this->jsonCreatedResponse(
            data: [
                'accessToken' => $user->createToken(config('app.name'))->accessToken,
            ],
            message: __('auth.register.success')
        );
    }

    // Todo: Email Verification
    // Todo: Oauth
}
