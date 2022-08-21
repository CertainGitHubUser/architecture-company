<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\UseCase\Room\CreateApartmentRooms;

use App\Module\Apartment\Application\DTO\Room\ApartmentRoomsRawDTO;
use App\Module\Common\Domain\ValueObject\UUID;

final class CreateApartmentRoomsRequest
{
    private ApartmentRoomsRawDTO $dto;

    private UUID $exposedApartmentId;

    public function __construct(UUID $exposedApartmentId, ApartmentRoomsRawDTO $dto)
    {
        $this->dto = $dto;
        $this->exposedApartmentId = $exposedApartmentId;
    }

    public function getDTO(): ApartmentRoomsRawDTO
    {
        return $this->dto;
    }

    public function getExposedApartmentId(): UUID
    {
        return $this->exposedApartmentId;
    }
}