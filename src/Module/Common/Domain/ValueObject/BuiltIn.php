<?php
declare(strict_types=1);

namespace App\Module\Common\Domain\ValueObject;

use App\Module\Common\Domain\Exception\InvalidBuiltInException;
use DateTimeImmutable;

final class BuiltIn extends AbstractValueObject
{
    public const DATE_FORMAT = 'Y-m-d';

    protected function initialConversion($value)
    {
        return (new DateTimeImmutable($value))->format(self::DATE_FORMAT);
    }

    /** @param DateTimeImmutable $value */
    protected function validate($value): void
    {
        if (new DateTimeImmutable($value) > new DateTimeImmutable('now')) {
            throw new InvalidBuiltInException($value->format(self::DATE_FORMAT));
        }
    }

    public static function fromDateTimeImmutable(DateTimeImmutable $value): self
    {
        return new self($value->format(self::DATE_FORMAT));
    }
}