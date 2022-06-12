<?php
declare(strict_types=1);

namespace App\Module\Common\Domain\Exception;

use Throwable;

final class InvalidPrimaryKeyException extends \Exception implements InvalidValueException
{
    //TODO provide error codes
    public const ERROR_CODE = 9;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        $message = "invalid primary key value:'{$message}'";

        parent::__construct($message, $code, $previous);
    }
}