<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Apartment\Message;

use App\Module\Apartment\Domain\Model\Apartment\Apartment;

final class ApartmentCreatedMessage
{
    private Apartment $apartment;

    private int $createdAt;

    public function __construct(Apartment $apartment, int $createdAt)
    {
        $this->apartment = $apartment;
        $this->createdAt = $createdAt;
    }

    public function getApartment(): Apartment
    {
        return $this->apartment;
    }

    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    public function getContent(): string
    {
        return ' ApartmentCreatedMessage ';
    }
}