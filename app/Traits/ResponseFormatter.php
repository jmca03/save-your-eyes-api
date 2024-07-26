<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

/**
 * Format Response
 *
 * This trait will be used to format response as needed.
 */
trait ResponseFormatter
{
    use SuccessfulJsonResponseFormatter, ErrorJsonResponseFormatter;
}
