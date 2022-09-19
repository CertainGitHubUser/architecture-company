<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Room;

use App\Module\Apartment\Domain\Model\Apartment\ValueObject\ApartmentId;
use App\Module\Common\Domain\ValueObject\UnsignedInt;
use App\Module\Common\Domain\ValueObject\UUID;

final class RoomsCollection implements \JsonSerializable
{
    /** @var Room[] */
    private array $rooms;

    /** @var array <apartmentId, Room[]> */
    private array $apartmentIdRoomMap;

    /** @var array <exposedId, Room> */
    private array $exposedIdRoomMap;

    private UnsignedInt $totalSquare;

    /** @var Room[] */
    public function __construct(array $rooms)
    {
        $this->rooms = $rooms;
        $this->makeApartmentIdRoomMap();
        $this->makeExposedIdRoomMap();
    }

    private function makeApartmentIdRoomMap(): void
    {
        $this->apartmentIdRoomMap = [];

        foreach ($this->rooms as $room) {
            $this->apartmentIdRoomMap[$room->apartmentId()->value()][] = $room;
        }
    }

    private function makeExposedIdRoomMap(): void
    {
        $this->exposedIdRoomMap = [];

        foreach ($this->rooms as $room) {
            $this->exposedIdRoomMap[$room->exposedId()->value()] = $room;
        }
    }

    public function getByApartmentId(ApartmentId $apartmentId): array
    {
        //TODO throw exception
        return $this->apartmentIdRoomMap[$apartmentId->value()];
    }

    public function getByExposedId(UUID $exposedId): Room
    {
        //TODO throw exception
        return $this->exposedIdRoomMap[$exposedId->value()];
    }

    public function countTotalSquare(): UnsignedInt
    {
        if (empty($this->totalSquare)) {
            $square = 0;

            foreach ($this->rooms as $room) {
                $square += $room->square()->value();
            }

            $this->totalSquare = new UnsignedInt($square);
        }

        return $this->totalSquare;
    }

    public function all(): array
    {
        return $this->rooms;
    }

    public function jsonSerialize()
    {
        return $this->rooms;
    }
}