<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\DTO\Room;

final class CreateApartmentRoomsRawDTO
{
    /** @var CreateApartmentRoomRawDTO[]  */
    public array $rooms;

    public static function initialize(array $rooms)
    {
        $dto = new self();

        $dto->rooms = [];

        foreach ($rooms  as $room) {
            $dto->rooms[] = CreateApartmentRoomRawDTO::fromArray($room);
        }

        return $dto;
    }
}