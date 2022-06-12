<?php

namespace App\Module\Apartment\Domain\Model\Apartment\Repository;

use App\Module\Apartment\Domain\Model\Apartment\Apartment;

interface ApartmentRepositoryInterface
{
    public function save(Apartment $apartment): void;
}