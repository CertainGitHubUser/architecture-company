<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\ApartmentAddress;

use App\Module\Apartment\Domain\Model\ApartmentAddress\Exception\InvalidApartmentAddressIdException;
use App\Module\Common\Domain\ValueObject\AbstractValueObject;

final class ApartmentAddressId extends AbstractValueObject
{
    protected function initialConversion($value)
    {
        return intval($value);
    }

    protected function validate($value): void
    {
        if ($value < 1) {
            throw new InvalidApartmentAddressIdException($value);
        }
    }
}