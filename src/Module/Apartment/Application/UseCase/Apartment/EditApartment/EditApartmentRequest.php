<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\UseCase\Apartment\EditApartment;

use App\Module\Apartment\Application\DTO\Apartment\EditApartmentRawDTO;
use App\Module\Common\Domain\ValueObject\UUID;
use App\Module\User\Domain\Model\User\UserId;

final class EditApartmentRequest
{
    private EditApartmentRawDTO $dto;

    private UUID $exposedId;

    public function __construct(EditApartmentRawDTO $dto, string $exposedId)
    {
        $this->dto = $dto;
        $this->exposedId = new UUID($exposedId);
    }

    public function getDTO(): EditApartmentRawDTO
    {
        return $this->dto;
    }

    public function getExposedId(): UUID
    {
        return $this->exposedId;
    }

    public function getOwnerId(): UserId
    {
        return new UserId($this->getDTO()->ownerId);
    }
}