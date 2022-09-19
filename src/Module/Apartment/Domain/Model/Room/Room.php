<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Room;

use App\Module\Apartment\Domain\Model\Apartment\ValueObject\ApartmentId;
use App\Module\Apartment\Domain\Model\Common\ValueObject\Square;
use App\Module\Apartment\Domain\Model\Room\ValueObject\RoomId;
use App\Module\Apartment\Domain\Model\Room\ValueObject\RoomType;
use App\Module\Common\Domain\ValueObject\UUID;

final class Room implements \JsonSerializable
{
    private RoomDTOInterface $dto;

    public function __construct(RoomDTOInterface $dto)
    {
        $this->dto = $dto;
    }

    public function getDTO(): RoomDTOInterface
    {
        return $this->dto;
    }

    public function id(): RoomId
    {
        return $this->dto->getId();
    }

    public function exposedId(): UUID
    {
        return $this->dto->getExposedId();
    }

    public function apartmentId(): ApartmentId
    {
        return $this->dto->getApartmentId();
    }

    public function roomType(): RoomType
    {
        return $this->dto->getRoomType();
    }

    public function square(): Square
    {
        return $this->dto->getSquare();
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->exposedId()->value(),
            'roomType' => $this->roomType()->value(),
            'square' => $this->square()->value(),
        ];
    }
}