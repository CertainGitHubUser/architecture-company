<?php
declare(strict_types=1);

namespace App\Module\Apartment\Tests\Utils\RequestDataGenerator;

class ApartmentAddressDataGenerator
{
    public static function generate(int $apartmentId, array $addresses): array
    {
        $result = [];

        foreach ($addresses as $address) {
            $result[] = [
                'id' => mt_rand(1, 3_000_000),
                'apartment_id' => $apartmentId,
                'address_id' => $address['id']
            ];
        }

        return $result;
    }
}