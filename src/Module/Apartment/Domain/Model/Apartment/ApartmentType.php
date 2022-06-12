<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Apartment;

use App\Module\Apartment\Domain\Model\Apartment\Exception\InvalidApartmentTypeException;
use App\Module\Common\Domain\ValueObject\AbstractValueObject;

final class ApartmentType extends AbstractValueObject
{
    public const APARTMENT_TYPE_STUDIO = 'Studio';

    public const APARTMENT_TYPE_ALCOVE_STUDIO = 'AlcoveStudio';

    public const APARTMENT_TYPE_CONVERTIBLE_STUDIO = 'ConvertibleStudio';

    public const APARTMENT_TYPE_MICRO_APARTMENT = 'MicroApartment';

    public const APARTMENT_TYPE_LOFT_APARTMENT = 'LoftApartment';

    public const APARTMENT_TYPE_REGULAR_APARTMENT = 'RegularApartment';

    public const APARTMENT_TYPES = [
        self::APARTMENT_TYPE_STUDIO,
        self::APARTMENT_TYPE_ALCOVE_STUDIO,
        self::APARTMENT_TYPE_CONVERTIBLE_STUDIO,
        self::APARTMENT_TYPE_MICRO_APARTMENT,
        self::APARTMENT_TYPE_LOFT_APARTMENT,
        self::APARTMENT_TYPE_REGULAR_APARTMENT
    ];

    protected function initialConversion($value)
    {
        return (string)$value;
    }

    protected function validate($value): void
    {
        if (in_array($value, self::APARTMENT_TYPES) === false) {
            throw new InvalidApartmentTypeException($value);
        }
    }
}