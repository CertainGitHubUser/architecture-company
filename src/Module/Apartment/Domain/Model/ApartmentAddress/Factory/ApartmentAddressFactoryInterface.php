<?php

namespace App\Module\Apartment\Domain\Model\ApartmentAddress\Factory;

use App\Module\Apartment\Domain\Model\Address\ValueObject\AddressId;
use App\Module\Apartment\Domain\Model\Apartment\ValueObject\ApartmentId;
use App\Module\Apartment\Domain\Model\ApartmentAddress\ApartmentAddress;
use App\Module\Apartment\Domain\Model\ApartmentAddress\ApartmentAddressDTOInterface;

interface ApartmentAddressFactoryInterface
{
    public function fromArgs(ApartmentId $apartmentId, AddressId $addressId): ApartmentAddress;

    public function fromEntity(ApartmentAddressDTOInterface $dto): ApartmentAddress;
}