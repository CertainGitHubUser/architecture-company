<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\UseCase\Room\EditApartmentRooms;

use App\Module\Apartment\Application\DTO\Room\EditApartmentRoomsRawDTO;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;

final class EditApartmentRoomsRequest
{
    private EditApartmentRoomsRawDTO $dto;

    private ApartmentId $apartmentId;

    public function __construct(ApartmentId $apartmentId, EditApartmentRoomsRawDTO $dto)
    {
        $this->apartmentId = $apartmentId;
        $this->dto = $dto;
    }

    public function getDTO(): EditApartmentRoomsRawDTO
    {
        return $this->dto;
    }

    public function getApartmentId(): ApartmentId
    {
        return $this->apartmentId;
    }
}