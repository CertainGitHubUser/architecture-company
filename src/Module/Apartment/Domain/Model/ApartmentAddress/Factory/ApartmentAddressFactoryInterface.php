<?php

namespace App\Module\Apartment\Domain\Model\ApartmentAddress\Factory;

use App\Module\Apartment\Domain\Model\Address\AddressId;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;
use App\Module\Apartment\Domain\Model\ApartmentAddress\ApartmentAddress;
use App\Module\Apartment\Domain\Model\ApartmentAddress\ApartmentAddressDTOInterface;

interface ApartmentAddressFactoryInterface
{
    public function fromArgs(ApartmentId $apartmentId, AddressId $addressId): ApartmentAddress;

    public function fromEntity(ApartmentAddressDTOInterface $dto): ApartmentAddress;
}