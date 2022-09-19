<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Common\ValueObject;

use App\Module\Apartment\Domain\Model\Common\Exception\InvalidSquareException;
use App\Module\Common\Domain\Constraints\MaxUnsignedInt;
use App\Module\Common\Domain\ValueObject\AbstractValueObject;

final class Square extends AbstractValueObject
{
    protected function initialConversion($value)
    {
        return (int)$value;
    }

    protected function validate($value): void
    {
        if ($value < 0 || $value > MaxUnsignedInt::VALUE) {
            throw new InvalidSquareException($value);
        }
    }
}