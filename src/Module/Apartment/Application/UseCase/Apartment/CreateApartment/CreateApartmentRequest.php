<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\UseCase\Apartment\CreateApartment;

use App\Module\Apartment\Application\DTO\Apartment\ApartmentRawDTO;
use App\Module\User\Domain\Model\User\UserId;

final class CreateApartmentRequest
{
    private ApartmentRawDTO $dto;

    public function __construct(ApartmentRawDTO $dto)
    {
        $this->dto = $dto;
    }

    public function getDTO(): ApartmentRawDTO
    {
        return $this->dto;
    }

    public function getOwnerId(): UserId
    {
        return new UserId($this->getDTO()->ownerId);
    }
}