<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Room\Exception;

use App\Module\Common\Domain\Exception\InvalidValueException;
use Throwable;

final class InvalidRoomTypeException extends \Exception implements InvalidValueException
{
    public function __construct($roomType = "", $code = 0, Throwable $previous = null)
    {
        $message = "invalid room type with value: '{$roomType}'";

        parent::__construct($message, $code, $previous);
    }
}