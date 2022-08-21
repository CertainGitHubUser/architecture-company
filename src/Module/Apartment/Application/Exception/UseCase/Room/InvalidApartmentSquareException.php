<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\Exception\UseCase\Room;

use App\Module\Common\Domain\Exception\InvalidValueException;
use Throwable;

final class InvalidApartmentSquareException extends \Exception implements InvalidValueException
{
    public function __construct($apartmentSquare, $roomsSquare,$code = 0, Throwable $previous = null)
    {
        $message = "invalid apartment square. Apartment square: '{$apartmentSquare}' must be bigger or equals then total rooms square '$roomsSquare'.";

        parent::__construct($message, $code, $previous);
    }
}