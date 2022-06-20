<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\DTO\Room;

use App\Module\Common\Application\DTO\InitializeFromArrayTrait;

final class CreateApartmentRoomRawDTO
{
    use InitializeFromArrayTrait;

    public string $roomType;

    public int $square;
}