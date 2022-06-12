<?php
declare(strict_types=1);

namespace App\Module\Common\Domain\ValueObject;

use App\Module\Common\Domain\Exception\InvalidUUIDException;
use Ramsey\Uuid\Uuid as UUIDPackage;

class UUID extends AbstractValueObject
{
    protected function initialConversion($value)
    {
        return (string)$value;
    }

    protected function validate($value): void
    {
        if (!UUIDPackage::isValid($value)) {
            throw new InvalidUUIDException($value);
        }
    }

    public static function generateNew(): self
    {
        return new self(UUIDPackage::fromBytes(random_bytes(16)));
    }
}