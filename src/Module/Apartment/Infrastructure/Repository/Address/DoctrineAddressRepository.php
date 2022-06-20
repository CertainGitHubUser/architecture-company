<?php
declare(strict_types=1);

namespace App\Module\Apartment\Infrastructure\Repository\Address;

use App\Module\Apartment\Domain\Model\Address\Address;
use App\Module\Apartment\Domain\Model\Address\AddressIdsCollection;
use App\Module\Apartment\Domain\Model\Address\Exception\AddressesWithExposedIdsNotFoundException;
use App\Module\Apartment\Domain\Model\Address\Factory\AddressesCollectionFactoryInterface;
use App\Module\Apartment\Domain\Model\Address\Factory\AddressFactoryInterface;
use App\Module\Apartment\Domain\Model\Address\Factory\AddressIdsCollectionFactoryInterface;
use App\Module\Apartment\Domain\Model\Address\Repository\AddressRepositoryInterface;
use App\Module\Apartment\Infrastructure\Entity\AddressEntity;
use App\Module\Common\Domain\ValueObject\UUIDsCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

final class DoctrineAddressRepository implements AddressRepositoryInterface
{
    private EntityManagerInterface $manager;
    private ObjectRepository $doctrineRepository;

    private AddressFactoryInterface $addressFactory;
    private AddressesCollectionFactoryInterface $addressesCollectionFactory;
    private AddressIdsCollectionFactoryInterface $addressIdsCollectionFactory;

    public function __construct(
        EntityManagerInterface               $manager,
        AddressFactoryInterface              $addressFactory,
        AddressesCollectionFactoryInterface  $addressesCollectionFactory,
        AddressIdsCollectionFactoryInterface $addressIdsCollectionFactory
    )
    {
        $this->manager = $manager;
        $this->doctrineRepository = $this->manager->getRepository(AddressEntity::class);

        $this->addressFactory = $addressFactory;
        $this->addressesCollectionFactory = $addressesCollectionFactory;
        $this->addressIdsCollectionFactory = $addressIdsCollectionFactory;
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

        return $this->addressIdsCollectionFactory->fromQuery($result);
    }

    public function save(Address $address): void
    {
        $this->manager->persist($address->getDto());
        $this->manager->flush();
    }
}