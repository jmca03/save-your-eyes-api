<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait JsonResponseFormatter
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
    public function jsonResponse(array $data, int $statusCode, string $message): JsonResponse
    {
        return response()->json([
            'data'       => $data,
            'statusCode' => $statusCode,
            'message'    => $message
        ], $statusCode);
    }
}
