<?php
declare(strict_types=1);

namespace App\Module\Apartment\Tests\Utils\RequestDataGenerator;

final class CreateApartmentRequestDataGenerator
{
    public static function fromApartmentData(array $apartmentData): string
    {
        return json_encode([
            'exposed_id' => $apartmentData['exposed_id'],
            "square" => $apartmentData['square'],
            "floor" => $apartmentData['floor'],
            "builtIn" => $apartmentData['built_in'],
            "rooms" => self::buildRooms($apartmentData['rooms'] ?? []),
            "ownerId" => "123",
            "price" => $apartmentData['price'],
            "apartmentType" => $apartmentData['apartment_type'],
            "heatingType" => $apartmentData['heating_type'],
            "rentalPrice" => $apartmentData['rental_price'],
            "currency" => $apartmentData['currency'],
            "addresses" => $apartmentData['addresses'] ?? [],
            "hasGas" => $apartmentData['has_gas'],
            "hasWater" => $apartmentData['has_water'],
            "hasHood" => $apartmentData['has_hood']
        ]);
    }

    private static function buildRooms(array $rawRooms): array
    {
        $rooms = [];

        foreach ($rawRooms as $rawRoom) {
            $rooms[] = [
                'roomType' => $rawRoom['room_type'],
                'square' => $rawRoom['square']
            ];
        }

        return $rooms;
    }
}