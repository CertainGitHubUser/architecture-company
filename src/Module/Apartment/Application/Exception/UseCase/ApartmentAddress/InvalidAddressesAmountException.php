<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\Exception\UseCase\ApartmentAddress;

use App\Module\Common\Domain\Exception\InvalidValueException;
use Throwable;

final class InvalidAddressesAmountException extends \Exception implements InvalidValueException
{
    public function __construct($amount, $code = 0, Throwable $previous = null)
    {
        $message = "invalid addresses amount: '{$amount}'. Apartment can have from 1 to 4 addresses.";

        parent::__construct($message, $code, $previous);
    }
}