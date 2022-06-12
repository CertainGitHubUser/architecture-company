<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Apartment;

use App\Module\Apartment\Domain\Model\Apartment\Exception\InvalidHeatingTypeException;
use App\Module\Common\Domain\ValueObject\AbstractValueObject;

final class HeatingType extends AbstractValueObject
{
    public const HEATING_TYPE_FURNACE = 'Furnace';

    public const HEATING_TYPE_HEAT_PUMP = 'HeatPump';

    public const HEATING_TYPE_HYBRID_HEATING = 'HybridHeating';

    public const HEATING_TYPE_DUCTLESS_MINI_SPLITS = 'DuctlessMiniSplits';

    public const HEATING_TYPE_RADIANT_HEATING = 'RadiantHeating';

    public const HEATING_TYPE_BASEBOARD_HEATERS = 'BaseboardHeaters';

    public const HEATING_TYPE_BOILER = 'Boiler';

    public const HEATING_TYPES = [
        self::HEATING_TYPE_FURNACE,
        self::HEATING_TYPE_HEAT_PUMP,
        self::HEATING_TYPE_HYBRID_HEATING,
        self::HEATING_TYPE_DUCTLESS_MINI_SPLITS,
        self::HEATING_TYPE_RADIANT_HEATING,
        self::HEATING_TYPE_BASEBOARD_HEATERS,
        self::HEATING_TYPE_BOILER,
    ];

    protected function initialConversion($value)
    {
        return (string)$value;
    }

    protected function validate($value): void
    {
        if (in_array($value, self::HEATING_TYPES) === false) {
            throw new InvalidHeatingTypeException($value);
        }
    }
}