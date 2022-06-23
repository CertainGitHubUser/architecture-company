<?php

namespace App\Module\Apartment\Domain\Model\Room\Factory;

use App\Module\Apartment\Application\DTO\Room\EditApartmentRoomRawDTO;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;
use App\Module\Apartment\Domain\Model\Common\Square;
use App\Module\Apartment\Domain\Model\Room\Room;
use App\Module\Apartment\Domain\Model\Room\RoomDTOInterface;
use App\Module\Apartment\Domain\Model\Room\RoomType;

interface RoomFactoryInterface
{
    public function fromArgs(ApartmentId $apartmentId, Square $square, RoomType $roomType): Room;

    //TODO rename to the fromEditApartmentRoomRawDT
    public function editApartmentRoomRawDTO(EditApartmentRoomRawDTO $dto): Room;

    public function fromEntity(RoomDTOInterface $dto): Room;
}