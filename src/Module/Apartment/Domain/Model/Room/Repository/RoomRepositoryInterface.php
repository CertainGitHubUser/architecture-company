<?php

namespace App\Module\Apartment\Domain\Model\Room\Repository;

use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;
use App\Module\Apartment\Domain\Model\Room\Room;
use App\Module\Apartment\Domain\Model\Room\RoomsCollection;

interface RoomRepositoryInterface
{
    public function getByApartmentId(ApartmentId $apartmentId): RoomsCollection;

    public function saveCollection(RoomsCollection $collection): void;

    public function save(Room $room): void;

    public function removeCollection(RoomsCollection $roomsCollection): void;

    public function remove(Room $room): void;
}