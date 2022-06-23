<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\UseCase\Apartment\RemoveApartment;

use App\Module\Common\Domain\ValueObject\UUID;

final class RemoveApartmentRequest
{
    private UUID $UUID;

    public function __construct(string $UUID)
    {
        $this->UUID = new UUID($UUID);
    }

    public function getUUID(): UUID
    {
        return $this->UUID;
    }
}