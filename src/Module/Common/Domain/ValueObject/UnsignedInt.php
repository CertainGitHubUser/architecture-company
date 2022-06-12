<?php

namespace App\Module\Common\Domain\ValueObject;

use App\Module\Common\Domain\Constraints\MaxUnsignedInt;
use App\Module\Common\Domain\Exception\InvalidUnsignedIntException;

class UnsignedInt extends AbstractValueObject
{
    protected function initialConversion($value)
    {
        return (int)$value;
    }

    protected function validate($value): void
    {
        if ($value < 0 || $value > MaxUnsignedInt::VALUE) {
            throw new InvalidUnsignedIntException($value);
        }
    }
}