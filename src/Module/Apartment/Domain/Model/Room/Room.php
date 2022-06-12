<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Room;

use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;
use App\Module\Apartment\Domain\Model\Common\Square;
use App\Module\Common\Domain\ValueObject\UUID;

final class Room
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
}