<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\DTO\Apartment;

use App\Module\Common\Application\DTO\InitializeFromArrayTrait;

final class CreateApartmentRawDTO
{
    use InitializeFromArrayTrait;

    public int $square;

    public int $floor;

    public string $builtIn;

    public int $ownerId;

    public int $price;

    public string $apartmentType;

    public string $heatingType;

    public int $rentalPrice;

    public string $currency;

    public bool $hasGas;

    public bool $hasWater;

    public bool $hasHood;

    public array $addresses;

    public array $rooms;

    public static function initialize(array $request): CreateApartmentRawDTO
    {
        $dto = self::fromArray($request);
        $dto->rooms = $request['rooms'];
        $dto->addresses = $request['addresses'];

        return $dto;
    }
}