<?php

namespace App\Module\Apartment\Domain\Model\Address;

use App\Module\Common\Domain\ValueObject\NotEmptyString;

interface AddressDTOInterface
{
    public function getId(): AddressId;

    public function setId($id): void;

    public function getCity(): NotEmptyString;

    public function setCity($city): void;

    public function getCountry(): NotEmptyString;

    public function setCountry($country): void;

    public function getStreet(): NotEmptyString;

    public function setStreet($street): void;

    public function getBuildingNumber(): NotEmptyString;

    public function setBuildingNumber($buildingNumber): void;

    public function getApartmentNumber(): NotEmptyString;

    public function setApartmentNumber($apartmentNumber): void;

    public function getLatitude(): Latitude;

    public function setLatitude($latitude): void;

    public function getLongitude(): Longitude;

    public function setLongitude($longitude): void;

    public function getZIPCode(): ZIPCode;

    public function setZIPCode($ZIPCode): void;
}