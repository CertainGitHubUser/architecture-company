<?php

namespace App\Module\Common\Domain\Exception;

use Throwable;

final class InvalidUnsignedIntException extends \Exception implements InvalidValueException
{
    public const ERROR_CODE = 9;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        $message = "invalid unsigned int '{$message}'";

        parent::__construct($message, $code, $previous);
    }
}