<?php
declare(strict_types=1);

namespace App\Module\Common\Domain\Exception;

use Throwable;

final class InvalidUUIDException extends \Exception implements InvalidValueException
{
    public const ERROR_CODE = 9;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        $message = "invalid UUID value:'{$message}'";

        parent::__construct($message, $code, $previous);
    }
}