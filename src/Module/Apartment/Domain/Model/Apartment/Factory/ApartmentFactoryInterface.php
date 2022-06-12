<?php

namespace App\Module\Apartment\Domain\Model\Apartment\Factory;

use App\Module\Apartment\Application\Application\DTO\Apartment\CreateApartmentRawDTO;
use App\Module\Apartment\Domain\Model\Apartment\Apartment;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentDTOInterface;

interface ApartmentFactoryInterface
{
    public function fromRawDTO(CreateApartmentRawDTO $dto): Apartment;

    public function fromEntity(ApartmentDTOInterface $dto): Apartment;
}