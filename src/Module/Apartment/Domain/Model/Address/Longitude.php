<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Address;

use App\Module\Apartment\Domain\Model\Address\Exception\InvalidLongitudeException;
use App\Module\Common\Domain\Utils\GetDigitsAfterDecimalAmountUtil;
use App\Module\Common\Domain\ValueObject\AbstractValueObject;

final class Longitude extends AbstractValueObject
{
    protected function initialConversion($value)
    {
        return floatval($value);
    }

    protected function validate($value): void
    {
        if ($value < -180.0 || $value > 180.0 || GetDigitsAfterDecimalAmountUtil::get($value) > 6) {
            throw new InvalidLongitudeException($value);
        }
    }
}