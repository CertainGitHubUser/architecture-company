<?php
declare(strict_types=1);

namespace App\Module\Apartment\Tests\Utils\RequestDataGenerator;

use App\Module\Common\Domain\ValueObject\UUID;

final class AddressDataGenerator
{
    public static function generateAnyAddressesWithIds(array $ids): array
    {
        $addresses = self::generateAnyAddresses(count($ids));

        for ($i = 0, $k = count($ids); $i < $k; $i++) {
            $addresses[$i]['exposed_id'] = $ids[$i];
        }

        return $addresses;
    }

    public static function generateAnyAddresses(int $amount): array
    {
        $result = [];

        for ($i = 0; $i < $amount; $i++) {
            $result[] = [
                'id' => mt_rand(1, 3_000_000),
                'city' => 'test',
                'country' => 'test',
                'street' => 'test',
                'apartment_number' => '123',
                'building_number' => '1234',
                'latitude' => '80.01',
                'longitude' => '80.22',
                'zipcode' => 123456,
                'exposed_id' => UUID::generateNew()->value()
            ];
        }

        return $result;
    }
}