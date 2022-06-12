<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\ApartmentAddress;

use App\Module\Apartment\Domain\Model\Address\AddressId;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;

final class ApartmentAddress
{
    private ApartmentAddressDTOInterface $dto;

    public function __construct(ApartmentAddressDTOInterface $dto)
    {
        $this->dto = $dto;
    }

    public function getDTO(): ApartmentAddressDTOInterface
    {
        return $this->dto;
    }

    public function id(): ApartmentAddressId
    {
        return $this->dto->getId();
    }

    public function apartmentId(): ApartmentId
    {
        return $this->dto->getApartmentId();
    }

    public function addressId(): AddressId
    {
        return $this->dto->getAddressId();
    }
}