<?php

namespace App\Module\Apartment\Domain\Model\ApartmentAddress;

use App\Module\Apartment\Domain\Model\Address\AddressId;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;

interface ApartmentAddressDTOInterface
{
    public function getId(): ApartmentAddressId;

    public function setId($apartmentAddressId): void;

    public function getApartmentId(): ApartmentId;

    public function setApartmentId($apartmentId): void;

    public function getAddressId(): AddressId;

    public function setAddressId($addressId): void;
}