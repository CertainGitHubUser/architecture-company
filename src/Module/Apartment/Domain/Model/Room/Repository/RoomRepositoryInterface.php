<?php

namespace App\Module\Apartment\Domain\Model\Room\Repository;

use App\Module\Apartment\Domain\Model\Room\Room;

interface RoomRepositoryInterface
{
    public function save(Room $room): void;
}