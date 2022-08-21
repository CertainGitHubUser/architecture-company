<?php
declare(strict_types=1);

namespace App\Module\Common\Domain\Exception;

use Throwable;

final class InvalidBuiltInException extends \Exception
{
    public function __construct($builtIn, $code = 0, Throwable $previous = null)
    {
        $message = "invalid built in: '{$builtIn}'";

        parent::__construct($message, $code, $previous);
    }
}