<?php
declare(strict_types=1);

namespace App\Module\Apartment\Infrastructure\Repository\Apartment;

use App\Module\Apartment\Domain\Model\Address\Factory\AddressesCollectionFactoryInterface;
use App\Module\Apartment\Domain\Model\Apartment\Apartment;
use App\Module\Apartment\Domain\Model\Apartment\Factory\ApartmentFactoryInterface;
use App\Module\Apartment\Domain\Model\Apartment\Factory\ApartmentsCollectionFactoryInterface;
use App\Module\Apartment\Domain\Model\Apartment\Repository\ApartmentRepositoryInterface;
use App\Module\Apartment\Infrastructure\Entity\ApartmentEntity;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

final class DoctrineApartmentRepository implements ApartmentRepositoryInterface
{
    private EntityManagerInterface $manager;
    private ObjectRepository $doctrineRepository;

    private ApartmentFactoryInterface $apartmentFactory;
    private ApartmentsCollectionFactoryInterface $apartmentsCollectionFactory;

    public function __construct(
        EntityManagerInterface              $manager,
        ApartmentFactoryInterface           $apartmentFactory,
        ApartmentsCollectionFactoryInterface $apartmentsCollectionFactory
    )
    {
        $this->manager = $manager;
        $this->doctrineRepository = $this->manager->getRepository(ApartmentEntity::class);

        $this->apartmentFactory = $apartmentFactory;
        $this->apartmentsCollectionFactory = $apartmentsCollectionFactory;
    }

    public function save(Apartment $apartment): void
    {
        $this->manager->persist($apartment->getDto());
        $this->manager->flush();
    }
}