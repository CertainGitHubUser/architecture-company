<?php
declare(strict_types=1);

namespace App\Module\Common\Domain\Exception;

use Throwable;

final class InvalidNotEmptyStringException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "invalid string - should be not empty '{$message}'";

        parent::__construct($message, $code, $previous);
    }
}