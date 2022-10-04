<?php
declare(strict_types=1);

namespace App\Module\Common\Domain\Exception;

use Throwable;

final class InvalidLimitedLengthStringException extends \Exception
{
    public function __construct(int $maxLength, $code = 0, Throwable $previous = null)
    {
        $message = "invalid limited string - should be not empty with max length: '{$maxLength}';";

        parent::__construct($message, $code, $previous);
    }
}