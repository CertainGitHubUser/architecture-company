<?php
declare(strict_types=1);

namespace App\Module\Apartment\Infrastructure\Factory\Apartment;

use App\Module\Apartment\Application\DTO\Apartment\CreateApartmentRawDTO;
use App\Module\Apartment\Domain\Model\Address\Factory\AddressIdsCollectionFactoryInterface;
use App\Module\Apartment\Domain\Model\Apartment\Apartment;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentDTOInterface;
use App\Module\Apartment\Domain\Model\Apartment\Factory\ApartmentFactoryInterface;
use App\Module\Apartment\Domain\Model\Room\Factory\RoomsCollectionFactoryInterface;
use App\Module\Apartment\Infrastructure\Entity\ApartmentEntity;
use App\Module\Common\Domain\ValueObject\UUID;

final class ApartmentFactory implements ApartmentFactoryInterface
{
    public function __construct(
        RoomsCollectionFactoryInterface      $roomsCollectionFactory,
        AddressIdsCollectionFactoryInterface $addressIdsCollectionFactory
    )
    {
        $this->roomsCollectionFactory = $roomsCollectionFactory;
        $this->addressIdsCollectionFactory = $addressIdsCollectionFactory;
    }

    public function fromCreateApartmentRawDTO(CreateApartmentRawDTO $dto): Apartment
    {
        $entity = new ApartmentEntity($dto);
        $entity->setExposedId(UUID::generateNew());
        //TODO will be replaced after user will be implemented
        $entity->setUserId(123);

        return $this->fromEntity($entity);
    }

    public function fromEntity(ApartmentDTOInterface $dto): Apartment
    {
        return new Apartment($dto);
    }
}