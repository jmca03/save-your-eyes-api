<?php

/*
| Language lines for response messages corresponding to various HTTP status codes.
| These messages are intended to provide a human-readable explanation for each status code.
|
*/

return [
    'api' => [
        // Using status codes
        200 => 'The request was successful.',
        201 => 'The resource was successfully created.',
        204 => 'The request was successful but there is no content to return.',
        400 => 'The request could not be understood or was missing required parameters.',
        401 => 'Authentication failed or user does not have permissions for the requested operation.',
        403 => 'Access is forbidden to the requested resource.',
        404 => 'The requested resource was not found.',
        422 => 'The request was well-formed but was unable to be followed due to semantic errors.',
        429 => 'Too many requests were made in a given amount of time.',
        500 => 'An error occurred on the server.',

        // Using slug
        'ok' => 'The request was successful.',
        'created' => 'The resource was successfully created.',
        'no-content' => 'The request was successful but there is no content to return.',
        'bad-request' => 'The request could not be understood or was missing required parameters.',
        'unauthorized' => 'Authentication failed or user does not have permissions for the requested operation.',
        'forbidden' => 'Access is forbidden to the requested resource.',
        'not-found' => 'The requested resource was not found.',
        'unprocessable-entity' => 'The request was well-formed but was unable to be followed due to semantic errors.',
        'too-many-requests' => 'Too many requests were made in a given amount of time.',
        'internal-server-error' => 'An error occurred on the server.',
    ]
];


