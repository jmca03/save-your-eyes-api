<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse;

interface ApiResponseInterface
{

    /**
     * General Json Response
     *
     * This is the basis for other json responses
     *
     * @param array  $data
     * @param int    $statusCode
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonResponse(array $data, int $statusCode, string $message): JsonResponse;


    /**
     * Json Response for successful response.
     *
     * @param array  $data
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonSuccessResponse(array $data, string $message = 'Success'): JsonResponse;

    /**
     * Json Response for resource created.
     *
     * @param array  $data
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonCreatedResponse(array $data, string $message = 'Created'): JsonResponse;

    /**
     * Json Response for no content.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonNoContentResponse(string $message = 'No content'): JsonResponse;

    /**
     * Json Response for bad request.
     *
     * @param array  $errors
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonBadRequestResponse(array $errors, string $message = 'Bad request'): JsonResponse;

    /**
     * Json Response for unauthorized access.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonUnauthorizedResponse(string $message = 'Unauthorized access'): JsonResponse;

    /**
     * Json Response for forbidden access.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonForbiddenResponse(string $message = 'Forbidden access'): JsonResponse;

    /**
     * Json Response for not found.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonNotFoundResponse(string $message = 'Not found'): JsonResponse;

    /**
     * Json Response for unprocessable entity.
     *
     * @param array  $errors
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonUnprocessableEntityResponse(array $errors, string $message = 'Unprocessable entity'): JsonResponse;

    /**
     * Json Response for too many requests.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonTooManyRequestsResponse(string $message = 'Too many requests'): JsonResponse;

    /**
     * Json Response for internal server error.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonInternalServerErrorResponse(string $message = 'Internal server error'): JsonResponse;
}
