<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait SuccessfulJsonResponseFormatter
{
    use JsonResponseFormatter {
        JsonResponseFormatter::jsonResponse as jsonResponseSuccessBasis;
    }

    /**
     * Json Response for successful response.
     *
     * @param array  $data
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonSuccessResponse(array $data, string $message = 'Success'): JsonResponse
    {
        return $this->jsonResponseSuccessBasis(
            data: $data,
            statusCode: 200,
            message: $message
        );
    }

    /**
     * Json Response for resource created.
     *
     * @param array  $data
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonCreatedResponse(array $data, string $message = 'Created'): JsonResponse
    {
        return $this->jsonResponseSuccessBasis(
            data: $data,
            statusCode: 201,
            message: $message
        );
    }

    /**
     * Json Response for no content.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonNoContentResponse(string $message = 'No content'): JsonResponse
    {
        return $this->jsonResponseSuccessBasis(
            data: [],
            statusCode: 204,
            message: $message
        );
    }
}
