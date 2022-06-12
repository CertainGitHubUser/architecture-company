<?php
declare(strict_types=1);

namespace App\Module\Common\Domain\Utils;

final class GetDigitsNumberAfterDecimalUtil
{
    public static function get(float $value): int
    {
        return strlen(explode('.', (string)$value)[1]);
    }
}