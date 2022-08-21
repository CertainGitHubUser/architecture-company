<?php
declare(strict_types=1);

namespace App\Module\Apartment\Tests\Utils\RequestDataGenerator;

final class EditApartmentRequestDataGenerator
{
    public static function fromApartmentData(array $apartmentData): string
    {
        return json_encode([
            'exposed_id' => $apartmentData['apartment']['exposed_id'],
            "square" => $apartmentData['apartment']['square'],
            "floor" => $apartmentData['apartment']['floor'],
            "builtIn" => $apartmentData['apartment']['built_in'],
            "rooms" => self::buildRooms($apartmentData['rooms'] ?? []),
            "ownerId" => "123",
            "price" => $apartmentData['apartment']['price'],
            "apartmentType" => $apartmentData['apartment']['apartment_type'],
            "heatingType" => $apartmentData['apartment']['heating_type'],
            "rentalPrice" => $apartmentData['apartment']['rental_price'],
            "currency" => $apartmentData['apartment']['currency'],
            "addresses" => $apartmentData['addresses'] ?? [],
            "hasGas" => $apartmentData['apartment']['has_gas'],
            "hasWater" => $apartmentData['apartment']['has_water'],
            "hasHood" => $apartmentData['apartment']['has_hood']
        ]);
    }

    private static function buildRooms(array $rawRooms): array
    {
        $rooms = [];

        foreach ($rawRooms as $rawRoom) {
            $rooms[] = [
                'id' => $rawRoom['exposed_id'],
                'roomType' => $rawRoom['room_type'],
                'square' => $rawRoom['square']
            ];
        }

        return $rooms;
    }
}