<?php
declare(strict_types=1);

namespace App\Module\Apartment\Infrastructure\Repository\Apartment;

use App\Module\Apartment\Domain\Model\Apartment\Apartment;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;
use App\Module\Apartment\Domain\Model\Apartment\Exception\Repository\ApartmentWithExposedIdNotFoundException;
use App\Module\Apartment\Domain\Model\Apartment\Exception\Repository\ApartmentWithIdNotFoundException;
use App\Module\Apartment\Domain\Model\Apartment\Factory\ApartmentFactoryInterface;
use App\Module\Apartment\Domain\Model\Apartment\Factory\ApartmentsCollectionFactoryInterface;
use App\Module\Apartment\Domain\Model\Apartment\Repository\ApartmentRepositoryInterface;
use App\Module\Apartment\Infrastructure\Entity\ApartmentEntity;
use App\Module\Common\Domain\ValueObject\UUID;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

final class DoctrineApartmentRepository implements ApartmentRepositoryInterface
{
    private EntityManagerInterface $manager;
    private ObjectRepository $doctrineRepository;

    private ApartmentFactoryInterface $apartmentFactory;
    private ApartmentsCollectionFactoryInterface $apartmentsCollectionFactory;

    public function __construct(
        EntityManagerInterface               $manager,
        ApartmentFactoryInterface            $apartmentFactory,
        ApartmentsCollectionFactoryInterface $apartmentsCollectionFactory
    )
    {
        $this->manager = $manager;
        $this->doctrineRepository = $this->manager->getRepository(ApartmentEntity::class);

        $this->apartmentFactory = $apartmentFactory;
        $this->apartmentsCollectionFactory = $apartmentsCollectionFactory;
    }

    public function get(ApartmentId $apartmentId): Apartment
    {
        $apartment = $this->doctrineRepository->find($apartmentId->value());

        if (empty($apartment)) {
            throw new ApartmentWithIdNotFoundException($apartmentId->value());
        }

        return $this->apartmentFactory->fromEntity($apartment);
    }

    public function hasId(ApartmentId $apartmentId): bool
    {
        $qb = $this->manager->createQueryBuilder();
        $qb->select('a.id')
            ->from(ApartmentEntity::class, 'a')
            ->where('a.id = :apartmentId')
            ->setParameter('apartmentId', $apartmentId->value());

        $result = $qb->getQuery()->getResult();


        if (empty($result)) {
            return false;
        }

        return true;
    }

    public function getByExposedId(UUID $exposedId): Apartment
    {
        $apartment = $this->doctrineRepository->findOneBy(['exposedId' => $exposedId->value()]);

        if (empty($apartment)) {
            throw new ApartmentWithExposedIdNotFoundException($exposedId->value());
        }

        return $this->apartmentFactory->fromEntity($apartment);
    }

    public function save(Apartment $apartment): void
    {
        $this->manager->persist($apartment->getDto());
        $this->manager->flush();
    }
}