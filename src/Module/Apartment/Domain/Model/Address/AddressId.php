<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Address;

use App\Module\Apartment\Domain\Model\Address\Exception\InvalidAddressIdException;
use App\Module\Common\Domain\ValueObject\AbstractValueObject;

final class AddressId extends AbstractValueObject
{
    protected function initialConversion($value)
    {
        return intval($value);
    }

    protected function validate($value): void
    {
        if ($value < 1) {
            throw new InvalidAddressIdException($value);
        }
    }
}