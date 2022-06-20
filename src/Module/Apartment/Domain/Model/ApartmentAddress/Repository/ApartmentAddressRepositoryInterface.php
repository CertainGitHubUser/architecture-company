<?php

namespace App\Module\Apartment\Domain\Model\ApartmentAddress\Repository;

use App\Module\Apartment\Domain\Model\ApartmentAddress\ApartmentAddress;
use App\Module\Apartment\Domain\Model\ApartmentAddress\ApartmentAddressesCollection;

interface ApartmentAddressRepositoryInterface
{
    public function saveCollection(ApartmentAddressesCollection $collection): void;

    public function save(ApartmentAddress $apartmentAddress): void;
}