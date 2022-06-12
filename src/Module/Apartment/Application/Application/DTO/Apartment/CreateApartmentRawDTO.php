<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\Application\DTO\Apartment;

use App\Module\Apartment\Application\Application\DTO\Room\CreateRoomRawDTO;
use App\Module\Common\Application\DTO\InitializeFromArrayTrait;

final class CreateApartmentRawDTO
{
    use InitializeFromArrayTrait;

    public int $square;

    public int $floor;

    public string $builtIn;

    /** @var CreateRoomRawDTO[] */
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

    public static function initialize(array $request): CreateApartmentRawDTO
    {
        $dto = self::fromArray($request);

        //TODO make different collection

        $dto->rooms  = [];

        foreach ($request['rooms']  as $room) {
            $dto->rooms[] = CreateRoomRawDTO::fromArray($room);
        }

        return $dto;
    }
}