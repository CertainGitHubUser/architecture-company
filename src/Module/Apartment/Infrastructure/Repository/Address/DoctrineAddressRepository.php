<?php
declare(strict_types=1);

namespace App\Module\Apartment\Infrastructure\Repository\Address;

use App\Module\Apartment\Domain\Model\Address\Address;
use App\Module\Apartment\Domain\Model\Address\AddressIdsCollection;
use App\Module\Apartment\Domain\Model\Address\Exception\AddressesWithExposedIdsNotFoundException;
use App\Module\Apartment\Domain\Model\Address\Exception\AddressesWithIdsNotFoundException;
use App\Module\Apartment\Domain\Model\Address\Repository\AddressRepositoryInterface;
use App\Module\Apartment\Infrastructure\Entity\AddressEntity;
use App\Module\Apartment\Infrastructure\Factory\Address\AddressIdsCollectionFactory;
use App\Module\Common\Domain\Factory\UUIDsCollectionFactory;
use App\Module\Common\Domain\ValueObject\UUIDsCollection;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineAddressRepository implements AddressRepositoryInterface
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function getExposedIdsByIds(AddressIdsCollection $addressIdsCollection): UUIDsCollection
    {
        $qb = $this->manager->createQueryBuilder();
        $qb->addSelect('e.exposedId')
            ->from(AddressEntity::class, 'e')
            ->add('where', $qb->expr()->in('e.id', $addressIdsCollection->toStringArray()));
        $result = $qb->getQuery()->getResult();

        if ($addressIdsCollection->count()->value() !== count($result)) {
            throw new AddressesWithIdsNotFoundException($addressIdsCollection->toString());
        }

        return UUIDsCollectionFactory::fromQuery($result);
    }

    public function getIdsByExposedIds(UUIDsCollection $UUIDsCollection): AddressIdsCollection
    {
        $qb = $this->manager->createQueryBuilder();
        $qb->addSelect('e.id')
            ->from(AddressEntity::class, 'e')
            ->add('where', $qb->expr()->in('e.exposedId', $UUIDsCollection->toStringArray()));
        $result = $qb->getQuery()->getResult();

        if ($UUIDsCollection->count()->value() !== count($result)) {
            throw new AddressesWithExposedIdsNotFoundException($UUIDsCollection->toString());
        }

        return AddressIdsCollectionFactory::fromQuery($result);
    }

    public function save(Address $address): void
    {
        $this->manager->persist($address->getDto());
        $this->manager->flush();
    }
}