<?php

namespace App\Module\Apartment\Domain\Model\Apartment\Repository;

use App\Module\Apartment\Domain\Model\Apartment\Apartment;
use App\Module\Apartment\Domain\Model\Apartment\Exception\Repository\ApartmentWithExposedIdNotFoundException;
use App\Module\Apartment\Domain\Model\Apartment\Exception\Repository\ApartmentWithIdNotFoundException;
use App\Module\Apartment\Domain\Model\Apartment\ValueObject\ApartmentId;
use App\Module\Common\Domain\ValueObject\UUID;

interface ApartmentRepositoryInterface
{
    /** @throws ApartmentWithIdNotFoundException */
    public function get(ApartmentId $apartmentId): Apartment;

    /** @throws ApartmentWithExposedIdNotFoundException */
    public function getByExposedId(UUID $exposedId): Apartment;

    public function getIdByExposedId(UUID $exposedId): ApartmentId;

    public function hasId(ApartmentId $apartmentId): bool;

    public function save(Apartment $apartment): void;

    public function remove(Apartment $apartment): void;
}