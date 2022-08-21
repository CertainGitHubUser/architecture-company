<?php

namespace App\Module\Apartment\Domain\Model\Address\Factory;

use App\Module\Apartment\Domain\Model\Address\AddressId;
use App\Module\Apartment\Domain\Model\Address\AddressIdsCollection;

interface AddressIdsCollectionFactoryInterface
{
    /** @param AddressId[] $addressIds */
    public static function fromList(array $addressIds): AddressIdsCollection;

    public static function fromQuery(array $addressIds): AddressIdsCollection;
}