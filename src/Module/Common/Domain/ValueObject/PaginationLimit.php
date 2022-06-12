<?php

namespace App\Module\Common\Domain\ValueObject;

use App\Module\Common\Domain\Exception\InvalidPaginationLimitException;

class PaginationLimit extends AbstractValueObject
{
    public const MAX_LIMIT = 3;

    protected function initialConversion($value)
    {
        return (int)$value;
    }

    protected function validate($value): void
    {
        if ($value < 0 || $value > static::MAX_LIMIT) {
            throw new InvalidPaginationLimitException($value);
        }
    }
}