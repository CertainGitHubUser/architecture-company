<?php
declare(strict_types=1);

namespace App\Module\Apartment\Infrastructure\Factory\Room;

use App\Module\Apartment\Application\DTO\Room\EditApartmentRoomRawDTO;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;
use App\Module\Apartment\Domain\Model\Common\Square;
use App\Module\Apartment\Domain\Model\Room\Factory\RoomFactoryInterface;
use App\Module\Apartment\Domain\Model\Room\Room;
use App\Module\Apartment\Domain\Model\Room\RoomDTOInterface;
use App\Module\Apartment\Domain\Model\Room\RoomType;
use App\Module\Apartment\Infrastructure\Entity\RoomEntity;
use App\Module\Common\Domain\ValueObject\UUID;

final class RoomFactory implements RoomFactoryInterface
{
    public function fromArgs(ApartmentId $apartmentId, Square $square, RoomType $roomType): Room
    {
        $room = new RoomEntity;
        $room->setApartmentId($apartmentId->value());
        $room->setExposedId(UUID::generateNew()->value());
        $room->setSquare($square->value());
        $room->setRoomType($roomType->value());

        return $this->fromEntity($room);
    }

    public function fromCreateApartmentRawDTO(Square $square, RoomType $roomType): Room
    {
        $room = new RoomEntity;
        $room->setSquare($square->value());
        $room->setRoomType($roomType->value());

        return $this->fromEntity($room);
    }

    public function fromEditApartmentRoomRawDTO(EditApartmentRoomRawDTO $dto): Room
    {
        $room = new RoomEntity;
        $room->setExposedId($dto->exposedId);
        $room->setSquare($dto->square);
        $room->setRoomType($dto->roomType);

        return $this->fromEntity($room);
    }

    public function fromEntity(RoomDTOInterface $dto): Room
    {
        return new Room($dto);
    }
}