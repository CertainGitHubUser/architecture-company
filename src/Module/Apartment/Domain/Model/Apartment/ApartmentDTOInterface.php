<?php

namespace App\Module\Apartment\Domain\Model\Apartment;

use App\Module\Apartment\Application\DTO\Apartment\ApartmentRawDTO;
use App\Module\Apartment\Application\DTO\Apartment\EditApartmentRawDTO;
use App\Module\Apartment\Domain\Model\Common\Square;
use App\Module\Apartment\Domain\Model\Room\RoomsCollection;
use App\Module\Common\Domain\ValueObject\BuiltIn;
use App\Module\Common\Domain\ValueObject\UnsignedInt;
use App\Module\Common\Domain\ValueObject\UUID;
use App\Module\Common\Domain\ValueObject\UUIDsCollection;
use App\Module\Price\Domain\Model\Currency\Currency;
use App\Module\Price\Domain\Model\Price\Price;
use App\Module\User\Domain\Model\User\UserId;

interface ApartmentDTOInterface
{
    public function getId(): ApartmentId;

    public function setId($id): void;

    public function getExposedId(): UUID;

    public function setExposedId($exposedId): void;

    public function getSquare(): Square;

    public function setSquare($square): void;

    public function getFloor(): UnsignedInt;

    public function setFloor($floor): void;

    public function getBuiltIn(): BuiltIn;

    public function setBuiltIn($builtIn): void;

    public function getRooms(): RoomsCollection;

    public function getUserId(): UserId;

    public function setUserId($userId): void;

    public function getPrice(): Price;

    public function setPrice($price): void;

    public function getApartmentType(): ApartmentType;

    public function setApartmentType($apartmentType): void;

    public function getHeatingType(): HeatingType;

    public function setHeatingType($heatingType): void;

    public function getRentalPrice(): ?Price;

    public function setRentalPrice($price = null): void;

    public function getCurrency(): Currency;

    public function setCurrency($currency): void;

    public function getExposedAddressIds(): UUIDsCollection;

    public function hasGas(): bool;

    public function setHasGas($hasGas): void;

    public function hasWater(): bool;

    public function setHasWater($hasWater): void;

    public function hasHood(): bool;

    public function setHasHood($hasHood): void;

    public function update(EditApartmentRawDTO $dto): void;
}