<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Address;

use App\Module\Apartment\Domain\Model\Address\Exception\InvalidLatitudeException;
use App\Module\Common\Domain\Utils\GetDigitsAfterDecimalAmountUtil;
use App\Module\Common\Domain\ValueObject\AbstractValueObject;

//TODO Make tests
final class Latitude extends AbstractValueObject
{
    protected function initialConversion($value)
    {
        return floatval($value);
    }

    protected function validate($value): void
    {
        if ($value < -90.0 || $value > 90.0 || GetDigitsAfterDecimalAmountUtil::get($value) > 6) {
            throw new InvalidLatitudeException($value);
        }
    }
}