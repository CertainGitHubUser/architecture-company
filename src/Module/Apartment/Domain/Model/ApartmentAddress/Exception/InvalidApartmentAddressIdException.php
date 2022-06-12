<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\ApartmentAddress\Exception;

use App\Module\Common\Domain\Exception\InvalidValueException;
use Throwable;

final class InvalidApartmentAddressIdException extends \Exception implements InvalidValueException
{
    public function __construct($apartmentAddressId = "", $code = 0, Throwable $previous = null)
    {
        $message = "invalid apartment address id: '{$apartmentAddressId}'";

        parent::__construct($message, $code, $previous);
    }
}