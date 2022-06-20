<?php

namespace App\Module\Apartment\Domain\Model\ApartmentAddress\Factory;

use App\Module\Apartment\Domain\Model\Address\AddressIdsCollection;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;
use App\Module\Apartment\Domain\Model\ApartmentAddress\ApartmentAddressesCollection;

interface ApartmentAddressesCollectionFactoryInterface
{
    public function fromArgs(ApartmentId $apartmentId, AddressIdsCollection $addressIdsCollection): ApartmentAddressesCollection;
}