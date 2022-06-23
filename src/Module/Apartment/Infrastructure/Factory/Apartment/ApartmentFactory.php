<?php
declare(strict_types=1);

namespace App\Module\Apartment\Infrastructure\Factory\Apartment;

use App\Module\Apartment\Application\DTO\Apartment\ApartmentRawDTO;
use App\Module\Apartment\Application\UseCase\Apartment\EditApartment\EditApartmentRequest;
use App\Module\Apartment\Domain\Model\Apartment\Apartment;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentDTOInterface;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;
use App\Module\Apartment\Domain\Model\Apartment\Factory\ApartmentFactoryInterface;
use App\Module\Apartment\Infrastructure\Entity\ApartmentEntity;
use App\Module\Common\Domain\ValueObject\UUID;

final class ApartmentFactory implements ApartmentFactoryInterface
{
    public function fromArgs(EditApartmentRequest $request, ApartmentId $apartmentId): Apartment
    {
        $entity = new ApartmentEntity($request->getDTO());
        $entity->setExposedId($request->getExposedId()->value());
        $entity->setId($apartmentId->value());
        $entity->setUserId($request->getOwnerId()->value());
        return $this->fromEntity($entity);
    }

    public function fromApartmentRawDTO(ApartmentRawDTO $dto): Apartment
    {
        $entity = new ApartmentEntity($dto);
        $entity->setExposedId(UUID::generateNew());
        $entity->setUserId(123);

        return $this->fromEntity($entity);
    }

    public function fromEntity(ApartmentDTOInterface $dto): Apartment
    {
        return new Apartment($dto);
    }
}