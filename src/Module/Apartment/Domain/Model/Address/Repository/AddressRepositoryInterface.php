<?php

namespace App\Module\Apartment\Domain\Model\Address\Repository;

use App\Module\Apartment\Domain\Model\Address\Address;

interface AddressRepositoryInterface
{
    public function save(Address $address): void;
}