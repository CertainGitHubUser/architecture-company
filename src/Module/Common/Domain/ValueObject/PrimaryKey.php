<?php
declare(strict_types=1);

namespace App\Module\Common\Domain\ValueObject;

use App\Module\Common\Domain\Constraints\MaxUnsignedInt;
use App\Module\Common\Domain\Exception\InvalidPrimaryKeyException;

class PrimaryKey extends AbstractValueObject
{
    protected function initialConversion($value)
    {
        return (int)$value;
    }

    protected function validate($value): void
    {
        if ($value < 0 || $value > MaxUnsignedInt::VALUE) {
            throw new InvalidPrimaryKeyException($value);
        }
    }
}