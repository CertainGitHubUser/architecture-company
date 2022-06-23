<?php

namespace App\Module\Apartment\Domain\Model\Address\Repository;

use App\Module\Apartment\Domain\Model\Address\Address;
use App\Module\Apartment\Domain\Model\Address\AddressIdsCollection;
use App\Module\Common\Domain\ValueObject\UUIDsCollection;

interface AddressRepositoryInterface
{
    public function getIdsByExposedIds(UUIDsCollection $UUIDsCollection): AddressIdsCollection;

    public function getExposedIdsByIds(AddressIdsCollection $addressIdsCollection): UUIDsCollection;

    public function save(Address $address): void;
}