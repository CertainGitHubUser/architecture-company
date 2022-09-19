<?php

namespace App\Module\Apartment\Domain\Model\Address\Factory;

use App\Module\Apartment\Domain\Model\Address\AddressIdsCollection;
use App\Module\Apartment\Domain\Model\Address\ValueObject\AddressId;

interface AddressIdsCollectionFactoryInterface
{
    /** @param \App\Module\Apartment\Domain\Model\Address\ValueObject\AddressId[] $addressIds */
    public static function fromList(array $addressIds): AddressIdsCollection;

    public static function fromQuery(array $addressIds): AddressIdsCollection;
}