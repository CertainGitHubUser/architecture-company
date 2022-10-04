<?php
declare(strict_types=1);

namespace App\Module\Common\Domain\ValueObject;

use App\Module\Common\Domain\Exception\InvalidLimitedLengthStringException;

abstract class LimitedLengthString extends AbstractValueObject
{
    protected int $maxLength;

    public function __construct($value, int $maxLength)
    {
        $this->maxLength = $maxLength;

        parent::__construct($value);
    }

    protected function initialConversion($value)
    {
        return (string)$value;
    }

    protected function validate($value): void
    {
        if (mb_strlen($value) < 1 && mb_strlen($value) > $this->maxLength) {
            throw new InvalidLimitedLengthStringException($value);
        }
    }
}