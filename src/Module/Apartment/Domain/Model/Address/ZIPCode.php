<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Address;

use App\Module\Apartment\Domain\Model\Address\Exception\InvalidZIPCodeException;
use App\Module\Common\Domain\ValueObject\AbstractValueObject;

final class ZIPCode extends AbstractValueObject
{
    protected function initialConversion($value)
    {
        return (string)$value;
    }

    protected function validate($value): void
    {
        if (strlen($value) > 32) {
            throw new InvalidZIPCodeException($value);
        }
    }
}