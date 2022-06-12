<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Room;

use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;

final class RoomsCollection
{
    /** @var Room[] */
    private array $rooms;

    /** @var array <apartmentId, Room[]> */
    private array $apartmentIdRoomMap;

    /** @var Room[] */
    public function __construct(array $rooms)
    {
        $this->rooms = $rooms;
        $this->makeApartmentIdRoomMap();
    }

    private function makeApartmentIdRoomMap(): void
    {
        $this->apartmentIdRoomMap = [];

        foreach ($this->rooms as $room) {
            $this->apartmentIdRoomMap[$room->apartmentId()->value()][] = $room;
        }
    }

    public function getByApartmentId(ApartmentId $apartmentId): array
    {
        return $this->apartmentIdRoomMap[$apartmentId->value()];
    }
}