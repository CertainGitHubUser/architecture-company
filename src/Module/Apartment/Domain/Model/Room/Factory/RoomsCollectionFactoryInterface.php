<?php

namespace App\Module\Apartment\Domain\Model\Room\Factory;

use App\Module\Apartment\Application\DTO\Room\ApartmentRoomsRawDTO;
use App\Module\Apartment\Domain\Model\Apartment\ValueObject\ApartmentId;
use App\Module\Apartment\Domain\Model\Room\RoomsCollection;

interface RoomsCollectionFactoryInterface
{
    public function fromQuery(array $items): RoomsCollection;

    public function fromCreateApartmentRawDTO(array $items): RoomsCollection;

    public function fromArgs(ApartmentRoomsRawDTO $dto, ApartmentId $apartmentId): RoomsCollection;
}