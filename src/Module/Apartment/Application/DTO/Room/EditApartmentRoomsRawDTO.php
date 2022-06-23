<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\DTO\Room;

//TODO refactor apartment raw DTOs
final class EditApartmentRoomsRawDTO
{
    /** @var EditApartmentRoomRawDTO[] */
    public array $rooms;

    public static function initialize(array $rooms): self
    {
        $dto = new self();

        $dto->rooms = [];

        foreach ($rooms as $room) {
            $roomDto = EditApartmentRoomRawDTO::fromArray($room);
            $roomDto->exposedId = $room['id'];

            $dto->rooms[] = $roomDto;
        }

        return $dto;
    }
}