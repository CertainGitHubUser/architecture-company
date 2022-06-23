<?php

namespace App\Module\Apartment\Domain\Model\Apartment\Factory;

use App\Module\Apartment\Application\DTO\Apartment\ApartmentRawDTO;
use App\Module\Apartment\Application\UseCase\Apartment\EditApartment\EditApartmentRequest;
use App\Module\Apartment\Domain\Model\Apartment\Apartment;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentDTOInterface;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;

interface ApartmentFactoryInterface
{
    public function fromArgs(EditApartmentRequest $request, ApartmentId $apartmentId): Apartment;

    public function fromApartmentRawDTO(ApartmentRawDTO $dto): Apartment;

    public function fromEntity(ApartmentDTOInterface $dto): Apartment;
}