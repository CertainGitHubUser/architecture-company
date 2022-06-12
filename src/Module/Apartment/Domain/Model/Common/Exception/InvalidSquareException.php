<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Common\Exception;

use App\Module\Common\Domain\Exception\InvalidValueException;
use Throwable;

class InvalidSquareException extends \Exception implements InvalidValueException
{
    public const ERROR_CODE = 9;

    public function __construct($message = "", $code = self::ERROR_CODE, Throwable $previous = null)
    {
        $message = "invalid unsigned int '{$message}'";

        parent::__construct($message, $code, $previous);
    }
}