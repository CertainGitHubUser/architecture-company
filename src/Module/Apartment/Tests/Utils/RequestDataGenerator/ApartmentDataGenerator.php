<?php
declare(strict_types=1);

namespace App\Module\Apartment\Tests\Utils\RequestDataGenerator;

use App\Module\Common\Domain\ValueObject\UUID;

final class ApartmentDataGenerator
{
    public static function generate(array $source): array
    {
        return [
            'id' => mt_rand(1, 2_500_000),
            'exposed_id' => $source['exposedId'] ?? UUID::generateNew()->value(),
            'square' => $source['square'] ?? 12345,
            'floor' => $source['floor'] ?? 3,
            'built_in' => $source['builtIn'] ?? '2009-06-15T13:45:30',
            'user_id' => $source['ownerId'] ?? '123',
            'price' => $source['price'] ?? '123456',
            'apartment_type' => $source['apartmentType'] ?? 'RegularApartment',
            'heating_type' => $source['heatingType'] ?? 'HeatPump',
            'rental_price' => $source['rentalPrice'] ?? '12345',
            'currency' => $source['currency'] ?? 'USD',
            'has_gas' => (int)($source['hasGas'] ?? true),
            'has_water' => (int)($source['hasWater'] ?? false),
            'has_hood' => (int)($source['hasHood'] ?? false)
        ];
    }
}