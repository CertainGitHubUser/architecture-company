<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\UseCase\Apartment\CreateApartment;

use App\Module\Apartment\Application\DTO\Apartment\CreateApartmentRawDTO;
use App\Module\User\Domain\Model\User\UserId;

final class CreateApartmentRequest
{
    private CreateApartmentRawDTO $dto;

    public function __construct(CreateApartmentRawDTO $dto)
    {
        $this->dto = $dto;
    }
    public function getDTO(): CreateApartmentRawDTO
    {
        return $this->dto;
    }

    public function getOwnerId(): UserId
    {
        return new UserId($this->getDTO()->ownerId);
    }
}