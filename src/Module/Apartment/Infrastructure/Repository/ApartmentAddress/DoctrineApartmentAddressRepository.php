<?php
declare(strict_types=1);

namespace App\Module\Apartment\Infrastructure\Repository\ApartmentAddress;

use App\Module\Apartment\Domain\Model\ApartmentAddress\ApartmentAddress;
use App\Module\Apartment\Domain\Model\ApartmentAddress\ApartmentAddressesCollection;
use App\Module\Apartment\Domain\Model\ApartmentAddress\Factory\ApartmentAddressesCollectionFactoryInterface;
use App\Module\Apartment\Domain\Model\ApartmentAddress\Factory\ApartmentAddressFactoryInterface;
use App\Module\Apartment\Domain\Model\ApartmentAddress\Repository\ApartmentAddressRepositoryInterface;
use App\Module\Apartment\Infrastructure\Entity\ApartmentAddressEntity;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

final class DoctrineApartmentAddressRepository implements ApartmentAddressRepositoryInterface
{
    private EntityManagerInterface $manager;
    private ObjectRepository $doctrineRepository;

    private ApartmentAddressFactoryInterface $apartmentAddressFactory;
    private ApartmentAddressesCollectionFactoryInterface $apartmentAddressesCollectionFactory;

    public function __construct(
        EntityManagerInterface                       $manager,
        ApartmentAddressFactoryInterface             $apartmentAddressFactory,
        ApartmentAddressesCollectionFactoryInterface $apartmentAddressesCollectionFactory
    )
    {
        $this->manager = $manager;
        $this->doctrineRepository = $this->manager->getRepository(ApartmentAddressEntity::class);

        $this->apartmentAddressFactory = $apartmentAddressFactory;
        $this->apartmentAddressesCollectionFactory = $apartmentAddressesCollectionFactory;
    }

    public function saveCollection(ApartmentAddressesCollection $collection): void
    {
        $addresses = $collection->all();

        foreach ($addresses as $address) {
            $this->save($address);
        }
    }

    public function save(ApartmentAddress $apartmentAddress): void
    {
        $this->manager->persist($apartmentAddress->getDto());
        $this->manager->flush();
    }
}