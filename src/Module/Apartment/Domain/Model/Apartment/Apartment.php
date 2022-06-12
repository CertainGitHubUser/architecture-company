<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Apartment;

use App\Module\Apartment\Domain\Model\ApartmentAddress\ApartmentAddressesCollection;
use App\Module\Apartment\Domain\Model\Common\Square;
use App\Module\Apartment\Domain\Model\Room\RoomsCollection;
use App\Module\Common\Domain\ValueObject\UnsignedInt;
use App\Module\Common\Domain\ValueObject\UUID;
use App\Module\Price\Domain\Model\Currency\Currency;
use App\Module\Price\Domain\Model\Price\Price;
use App\Module\User\Domain\Model\User\User;

final class Apartment
{
    private ApartmentDTOInterface $dto;

    public function __construct(ApartmentDTOInterface $dto)
    {
        $this->dto = $dto;
    }

    public function getDTO(): ApartmentDTOInterface
    {
        return $this->dto;
    }

    public function id(): ApartmentId
    {
        return $this->dto->getId();
    }

    public function exposedId(): UUID
    {
        return $this->dto->getExposedId();
    }

    public function square(): Square
    {
        return $this->dto->getSquare();
    }

    public function floor(): UnsignedInt
    {
        return $this->dto->getFloor();
    }

    public function builtIn(): \DateTimeImmutable
    {
        return $this->dto->getBuiltIn();
    }

    public function rooms(): RoomsCollection
    {
        return $this->dto->getRooms();
    }

    public function owner(): User
    {
        return $this->dto->getOwner();
    }

    public function price(): Price
    {
        return $this->dto->getPrice();
    }

    public function apartmentType(): ApartmentType
    {
        return $this->dto->getApartmentType();
    }

    public function heatingType(): HeatingType
    {
        return $this->dto->getHeatingType();
    }

    public function rentalPrice(): ?Price
    {
        return $this->dto->getRentalPrice();
    }

    public function currency(): Currency
    {
        return $this->dto->getCurrency();
    }

    public function addresses(): ApartmentAddressesCollection
    {
        return $this->dto->getAddresses();
    }

    public function hasGas(): bool
    {
        return $this->dto->hasGas();
    }

    public function hasWater(): bool
    {
        return $this->dto->hasWater();
    }

    public function hasHood(): bool
    {
        return $this->dto->hasHood();
    }
}