<?php

namespace App\Support;

class ApiErrorCodes
{
    const UNKNOWN_ERROR = -1;

    const ALL_ERRORS = [
        'TRANSFORMER_ERRORS' => [
            'EVENTS'                    => 9910,
        ],
        'GENERAL_ERRORS' => [
        ],
        'LOGIN_ERRORS' => [
            'INVALID_TOKEN'         => 2002,
        ],
        'EVENT_ERRORS' => [
            'NO_EVENTS'           => 5001,
            'EVENT_NOT_FOUND'     => 5002,
        ],
        'COMMENT_ERRORS' => [
            'NO_COMMENTS'           => 6001,
            'COMMENT_NOT_FOUND'     => 6002,
            'NO_SAVE_COMMENTS'     => 6003,
            'NO_DELETE_COMMENTS'     => 6004,
            'NO_UPDATE_COMMENTS'     => 6005,
        ],
    ];

    public static function getError($category, $name): int
    {
        return self::ALL_ERRORS[$category][$name] ?? self::UNKNOWN_ERROR;
    }
}
