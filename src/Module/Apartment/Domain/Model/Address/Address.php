<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Address;

use App\Module\Apartment\Domain\Model\Address\ValueObject\AddressId;
use App\Module\Apartment\Domain\Model\Address\ValueObject\Latitude;
use App\Module\Apartment\Domain\Model\Address\ValueObject\Longitude;
use App\Module\Apartment\Domain\Model\Address\ValueObject\ZIPCode;
use App\Module\Common\Domain\ValueObject\NotEmptyString;
use App\Module\Common\Domain\ValueObject\UUID;

final class Address
{
    private AddressDTOInterface $dto;

    public function __construct(AddressDTOInterface $dto)
    {
        $this->dto = $dto;
    }

    public function getDTO(): AddressDTOInterface
    {
        return $this->dto;
    }

    public function id(): AddressId
    {
        return $this->dto->getId();
    }

    public function exposedId(): UUID
    {
        return $this->dto->getExposedId();
    }

    public function city(): NotEmptyString
    {
        return $this->dto->getCity();
    }

    public function country(): NotEmptyString
    {
        return $this->dto->getCountry();
    }

    public function street(): NotEmptyString
    {
        return $this->dto->getStreet();
    }

    public function buildingNumber(): NotEmptyString
    {
        return $this->dto->getBuildingNumber();
    }

    public function apartmentNumber(): NotEmptyString
    {
        return $this->dto->getApartmentNumber();
    }

    public function latitude(): Latitude
    {
        return $this->dto->getLatitude();
    }

    public function longitude(): Longitude
    {
        return $this->dto->getLongitude();
    }

    public function ZIPCode(): ZIPCode
    {
        return $this->dto->getZIPCode();
    }
}