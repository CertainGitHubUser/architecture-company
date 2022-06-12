<?php

namespace App\Module\Apartment\Domain\Model\ApartmentAddress\Repository;

use App\Module\Apartment\Domain\Model\ApartmentAddress\ApartmentAddress;

interface ApartmentAddressRepositoryInterface
{
    public function save(ApartmentAddress $apartmentAddress): void;
}