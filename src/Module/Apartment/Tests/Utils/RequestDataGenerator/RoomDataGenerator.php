<?php
declare(strict_types=1);

namespace App\Module\Apartment\Tests\Utils\RequestDataGenerator;

final class RoomDataGenerator
{
    /**
     * @param array $config contains following params:
     *  'exposed_id'   => type uuid;
     *  'apartment_id' => type int;
     *  'room_type'    => type string;
     *  'square'       => type string;
     * @return array
     */
    public static function fromApartmentConfigAndApartmentId(int $apartmentId, array $config): array
    {
        $result = [];
        foreach ($config as $item) {
            $item['id'] = mt_rand(1, 3_000_000);
            $item['apartment_id'] = $apartmentId;
            $result[]= $item;
        }

        return $result;
    }

}