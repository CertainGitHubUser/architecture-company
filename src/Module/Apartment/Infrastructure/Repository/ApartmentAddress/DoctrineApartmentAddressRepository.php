<?php
declare(strict_types=1);

namespace App\Module\Apartment\Infrastructure\Repository\ApartmentAddress;

use App\Module\Apartment\Domain\Model\Apartment\ValueObject\ApartmentId;
use App\Module\Apartment\Domain\Model\ApartmentAddress\ApartmentAddress;
use App\Module\Apartment\Domain\Model\ApartmentAddress\ApartmentAddressesCollection;
use App\Module\Apartment\Domain\Model\ApartmentAddress\Factory\ApartmentAddressesCollectionFactoryInterface;
use App\Module\Apartment\Domain\Model\ApartmentAddress\Repository\ApartmentAddressRepositoryInterface;
use App\Module\Apartment\Infrastructure\Entity\ApartmentAddressEntity;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

final class DoctrineApartmentAddressRepository implements ApartmentAddressRepositoryInterface
{
    private EntityManagerInterface $manager;
    private ObjectRepository $doctrineRepository;

    private ApartmentAddressesCollectionFactoryInterface $apartmentAddressesCollectionFactory;

    public function __construct(
        EntityManagerInterface                       $manager,
        ApartmentAddressesCollectionFactoryInterface $apartmentAddressesCollectionFactory
    )
    {
        $this->manager = $manager;
        $this->doctrineRepository = $this->manager->getRepository(ApartmentAddressEntity::class);

        $this->apartmentAddressesCollectionFactory = $apartmentAddressesCollectionFactory;
    }

    public function getByApartmentId(ApartmentId $id): ApartmentAddressesCollection
    {
        $result = $this->doctrineRepository->findBy(['apartmentId' => $id->value()]);

        return $this->apartmentAddressesCollectionFactory->fromQuery($result);
    }

    public function addressesAreAvailable(ApartmentAddressesCollection $collection): bool
    {
        $result = $this->doctrineRepository->findBy(['addressId' => $collection->getAllAddressIdsAsStringArray()]);

        return empty($result);
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

    public function removeCollection(ApartmentAddressesCollection $collection): void
    {
        foreach ($collection->all() as $item) {
            $this->manager->remove($item->getDTO());
        }

        $this->manager->flush();
    }
}