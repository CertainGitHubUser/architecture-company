<?php
declare(strict_types=1);

namespace App\Module\Common\Domain\Utils;

final class AssertArraysEquals
{
    public static function eq(array $arr1, array $arr2): bool
    {
        if (count($arr1) !== count($arr2)) {
            return false;
        }

        foreach ($arr1 as $key => $value) {
            if (is_array($value)) {
                if (!is_array($arr2[$key])) {
                    return false;
                }

                if (self::eq($arr1[$key], $arr2[$key]) === false)
                {
                    return false;
                }
            }

            if (($arr2[$key] === null) || ($arr2[$key] !== $arr1[$key])) {
                return false;
            }
        }

        return true;
    }
}