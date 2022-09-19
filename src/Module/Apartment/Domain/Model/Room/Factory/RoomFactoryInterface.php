<?php

namespace App\Module\Apartment\Domain\Model\Room\Factory;

use App\Module\Apartment\Application\DTO\Room\EditApartmentRoomRawDTO;
use App\Module\Apartment\Domain\Model\Apartment\ValueObject\ApartmentId;
use App\Module\Apartment\Domain\Model\Common\ValueObject\Square;
use App\Module\Apartment\Domain\Model\Room\Room;
use App\Module\Apartment\Domain\Model\Room\RoomDTOInterface;
use App\Module\Apartment\Domain\Model\Room\ValueObject\RoomType;

interface RoomFactoryInterface
{
    public function fromArgs(ApartmentId $apartmentId, Square $square, RoomType $roomType): Room;

    public function fromCreateApartmentRawDTO(Square $square, RoomType $roomType): Room;

    public function fromEditApartmentRoomRawDTO(EditApartmentRoomRawDTO $dto): Room;

    public function fromEntity(RoomDTOInterface $dto): Room;
}