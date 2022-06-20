<?php

namespace App\Module\Apartment\Domain\Model\Room\Repository;

use App\Module\Apartment\Domain\Model\Room\Room;
use App\Module\Apartment\Domain\Model\Room\RoomsCollection;

interface RoomRepositoryInterface
{
    public function saveCollection(RoomsCollection $collection): void;

    public function save(Room $room): void;
}