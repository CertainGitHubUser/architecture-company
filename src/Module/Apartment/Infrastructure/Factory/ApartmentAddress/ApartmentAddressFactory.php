<?php

namespace App\Module\Apartment\Infrastructure\Factory\ApartmentAddress;

use App\Module\Apartment\Domain\Model\Address\AddressId;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;
use App\Module\Apartment\Domain\Model\ApartmentAddress\ApartmentAddress;
use App\Module\Apartment\Domain\Model\ApartmentAddress\ApartmentAddressDTOInterface;
use App\Module\Apartment\Domain\Model\ApartmentAddress\Factory\ApartmentAddressFactoryInterface;
use App\Module\Apartment\Infrastructure\Entity\ApartmentAddressEntity;

final class ApartmentAddressFactory implements ApartmentAddressFactoryInterface
{
    public function fromArgs(ApartmentId $apartmentId, AddressId $addressId): ApartmentAddress
    {
        $entity = new ApartmentAddressEntity();

        $entity->setApartmentId($apartmentId->value());
        $entity->setAddressId($addressId->value());

        return $this->fromEntity($entity);
    }

    public function fromEntity(ApartmentAddressDTOInterface $dto): ApartmentAddress
    {
        return new ApartmentAddress($dto);
    }
}