<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ErrorJsonResponseFormatter
{
    use JsonResponseFormatter {
        JsonResponseFormatter::jsonResponse as jsonResponseErrorBasis;
    }

    /**
     * Json Response for bad request.
     *
     * @param array  $errors
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonBadRequestResponse(array $errors, string $message = 'Bad request'): JsonResponse
    {
        return $this->jsonResponseErrorBasis(
            data: ['errors' => $errors],
            statusCode: 400,
            message: $message
        );
    }

    /**
     * Json Response for unauthorized access.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonUnauthorizedResponse(string $message = 'Unauthorized access'): JsonResponse
    {
        return $this->jsonResponseErrorBasis(
            data: [],
            statusCode: 401,
            message: $message
        );
    }

    /**
     * Json Response for forbidden access.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonForbiddenResponse(string $message = 'Forbidden access'): JsonResponse
    {
        return $this->jsonResponseErrorBasis(
            data: [],
            statusCode: 403,
            message: $message
        );
    }

    /**
     * Json Response for not found.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonNotFoundResponse(string $message = 'Not Found'): JsonResponse
    {
        return $this->jsonResponseErrorBasis(
            data: [],
            statusCode: 404,
            message: $message
        );
    }

    /**
     * Json Response for unprocessable entity.
     *
     * @param array  $errors
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonUnprocessableEntityResponse(array $errors, string $message = 'Unprocessable entity'): JsonResponse
    {
        return $this->jsonResponseErrorBasis(
            data: ['errors' => $errors],
            statusCode: 422,
            message: $message
        );
    }

    /**
     * Json Response for too many requests.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonTooManyRequestsResponse(string $message = 'Too many requests'): JsonResponse
    {
        return $this->jsonResponseErrorBasis(
            data: [],
            statusCode: 429,
            message: $message
        );
    }

    /**
     * Json Response for internal server error.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonInternalServerErrorResponse(string $message = 'Internal server error'): JsonResponse
    {
        return $this->jsonResponseErrorBasis(
            data: [],
            statusCode: 500,
            message: $message
        );
    }
}
