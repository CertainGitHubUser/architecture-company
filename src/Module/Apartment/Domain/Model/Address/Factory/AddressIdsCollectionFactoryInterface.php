<?php

namespace App\Module\Apartment\Domain\Model\Address\Factory;

use App\Module\Apartment\Domain\Model\Address\AddressIdsCollection;

interface AddressIdsCollectionFactoryInterface
{
    public function fromQuery(array $addressIds): AddressIdsCollection;
}