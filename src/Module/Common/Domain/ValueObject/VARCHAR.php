<?php
declare(strict_types=1);

namespace App\Module\Common\Domain\ValueObject;

final class VARCHAR extends LimitedLengthString
{
    public const MAX_LENGTH = 255;

    public function __construct($value)
    {
        parent::__construct($value, self::MAX_LENGTH);
    }
}