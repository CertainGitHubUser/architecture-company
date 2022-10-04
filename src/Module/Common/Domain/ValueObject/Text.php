<?php
declare(strict_types=1);

namespace App\Module\Common\Domain\ValueObject;

final class Text extends LimitedLengthString
{
    public const MAX_LENGTH = 5000;

    public function __construct($value)
    {
        parent::__construct($value, self::MAX_LENGTH);
    }
}