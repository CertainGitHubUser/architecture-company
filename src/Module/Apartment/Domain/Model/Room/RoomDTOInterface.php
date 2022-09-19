<?php

namespace App\Module\Apartment\Domain\Model\Room;

use App\Module\Apartment\Application\DTO\Room\EditApartmentRoomRawDTO;
use App\Module\Apartment\Domain\Model\Apartment\ValueObject\ApartmentId;
use App\Module\Apartment\Domain\Model\Common\ValueObject\Square;
use App\Module\Apartment\Domain\Model\Room\ValueObject\RoomId;
use App\Module\Apartment\Domain\Model\Room\ValueObject\RoomType;
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

    public function update(EditApartmentRoomRawDTO $dto): void;
}