<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\DTO\Apartment;

use App\Module\Common\Application\DTO\InitializeFromArrayTrait;

class ApartmentRawDTO
{
    use InitializeFromArrayTrait;

    public int $square;

    public int $floor;

    public string $builtIn;

    public array $rooms;

    public int $ownerId;

    public int $price;

    public string $apartmentType;

    public string $heatingType;

    public int $rentalPrice;

    public string $currency;

    public array $addresses;

    public bool $hasGas;

    public bool $hasWater;

    public bool $hasHood;

    public array $rawRequest;

    public static function initialize(array $request): ApartmentRawDTO
    {
        $dto = self::fromArray($request);
        $dto->rawRequest = $request;
        $dto->rooms = $request['rooms'];

        return $dto;
    }
}