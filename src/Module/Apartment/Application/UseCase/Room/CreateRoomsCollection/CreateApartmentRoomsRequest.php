<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\UseCase\Room\CreateRoomsCollection;

use App\Module\Apartment\Application\DTO\Room\CreateApartmentRoomsRawDTO;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;

final class CreateApartmentRoomsRequest
{
    private CreateApartmentRoomsRawDTO $dto;

    private ApartmentId $apartmentId;

    public function __construct(ApartmentId $apartmentId, CreateApartmentRoomsRawDTO $dto)
    {
        $this->dto = $dto;
        $this->apartmentId = $apartmentId;
    }

    public function getDTO(): CreateApartmentRoomsRawDTO
    {
        return $this->dto;
    }

    public function getApartmentId(): ApartmentId
    {
        return $this->apartmentId;
    }
}