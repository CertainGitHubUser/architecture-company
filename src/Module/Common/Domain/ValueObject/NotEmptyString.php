<?php
declare(strict_types=1);

namespace App\Module\Common\Domain\ValueObject;

use App\Module\Common\Domain\Exception\InvalidNotEmptyStringException;

class NotEmptyString extends AbstractValueObject
{
    protected function initialConversion($value)
    {
        return (string)$value;
    }

    protected function validate($value): void
    {
        if (mb_strlen($value) < 1) {
            throw new InvalidNotEmptyStringException($value);
        }
    }
}