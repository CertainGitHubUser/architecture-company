<?php
declare(strict_types=1);

namespace App\Module\Apartment\Infrastructure\Repository\Address;

use App\Module\Apartment\Domain\Model\Address\Address;
use App\Module\Apartment\Domain\Model\Address\Factory\AddressesCollectionFactoryInterface;
use App\Module\Apartment\Domain\Model\Address\Factory\AddressFactoryInterface;
use App\Module\Apartment\Domain\Model\Address\Repository\AddressRepositoryInterface;
use App\Module\Apartment\Infrastructure\Entity\AddressEntity;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

final class DoctrineAddressRepository implements AddressRepositoryInterface
{
    private EntityManagerInterface $manager;
    private ObjectRepository $doctrineRepository;

    private AddressFactoryInterface $addressFactory;
    private AddressesCollectionFactoryInterface $addressesCollectionFactory;

    public function __construct(
        EntityManagerInterface              $manager,
        AddressFactoryInterface             $addressFactory,
        AddressesCollectionFactoryInterface $addressesCollectionFactory
    )
    {
        $this->manager = $manager;
        $this->doctrineRepository = $this->manager->getRepository(AddressEntity::class);

        $this->addressFactory = $addressFactory;
        $this->addressesCollectionFactory = $addressesCollectionFactory;
    }

    public function save(Address $address): void
    {
        $this->manager->persist($address->getDto());
        $this->manager->flush();
    }
}