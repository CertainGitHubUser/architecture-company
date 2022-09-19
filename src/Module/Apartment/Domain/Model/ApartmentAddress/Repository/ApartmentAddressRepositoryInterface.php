<?php

namespace App\Module\Apartment\Domain\Model\ApartmentAddress\Repository;

use App\Module\Apartment\Domain\Model\Apartment\ValueObject\ApartmentId;
use App\Module\Apartment\Domain\Model\ApartmentAddress\ApartmentAddress;
use App\Module\Apartment\Domain\Model\ApartmentAddress\ApartmentAddressesCollection;

interface ApartmentAddressRepositoryInterface
{
    public function getByApartmentId(ApartmentId $id): ApartmentAddressesCollection;

    public function addressesAreAvailable(ApartmentAddressesCollection $collection): bool;

    public function saveCollection(ApartmentAddressesCollection $collection): void;

    public function save(ApartmentAddress $apartmentAddress): void;

    public function removeCollection(ApartmentAddressesCollection $collection): void;
}