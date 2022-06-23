<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\UseCase\Room\CreateApartmentRooms;

use App\Module\Apartment\Application\DTO\Room\ApartmentRoomsRawDTO;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;

final class CreateApartmentRoomsRequest
{
    private ApartmentRoomsRawDTO $dto;

    private ApartmentId $apartmentId;

    public function __construct(ApartmentId $apartmentId, ApartmentRoomsRawDTO $dto)
    {
        $this->dto = $dto;
        $this->apartmentId = $apartmentId;
    }

    public function getDTO(): ApartmentRoomsRawDTO
    {
        return $this->dto;
    }

    public function getApartmentId(): ApartmentId
    {
        return $this->apartmentId;
    }
}