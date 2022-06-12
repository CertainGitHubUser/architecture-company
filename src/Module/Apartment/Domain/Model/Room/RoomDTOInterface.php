<?php

namespace App\Module\Apartment\Domain\Model\Room;

use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;
use App\Module\Apartment\Domain\Model\Common\Square;
use App\Module\Common\Domain\ValueObject\UUID;

interface RoomDTOInterface
{
    public function getId(): RoomId;

    public function setId($id): void;

    public function getExposedId(): UUID;

    public function setExposedId($exposedId): void;

    public function getApartmentId(): ApartmentId;

    public function setApartmentId($apartmentId): void;

    public function getRoomType(): RoomType;

    public function setRoomType($roomType): void;

    public function getSquare(): Square;

    public function setSquare($square): void;
}