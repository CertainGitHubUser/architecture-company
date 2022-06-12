<?php

namespace App\Module\Common\Domain\Exception;

use App\Module\Common\Domain\ValueObject\PaginationLimit;
use Throwable;

final class InvalidPaginationLimitException extends \Exception implements InvalidValueException
{
    public const ERROR_CODE = 8;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        $message = "invalid pagination limit '{$message}'. Allowed range is from 1 to ". PaginationLimit::MAX_LIMIT;

        parent::__construct($message, $code, $previous);
    }
}