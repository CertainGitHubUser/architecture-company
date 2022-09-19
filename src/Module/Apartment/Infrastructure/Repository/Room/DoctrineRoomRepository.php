<?php
declare(strict_types=1);

namespace App\Module\Apartment\Infrastructure\Repository\Room;

use App\Module\Apartment\Domain\Model\Apartment\ValueObject\ApartmentId;
use App\Module\Apartment\Domain\Model\Room\Factory\RoomFactoryInterface;
use App\Module\Apartment\Domain\Model\Room\Factory\RoomsCollectionFactoryInterface;
use App\Module\Apartment\Domain\Model\Room\Repository\RoomRepositoryInterface;
use App\Module\Apartment\Domain\Model\Room\Room;
use App\Module\Apartment\Domain\Model\Room\RoomsCollection;
use App\Module\Apartment\Infrastructure\Entity\RoomEntity;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

final class DoctrineRoomRepository implements RoomRepositoryInterface
{
    private EntityManagerInterface $manager;
    private ObjectRepository $doctrineRepository;

    private RoomsCollectionFactoryInterface $roomsCollectionFactory;

    public function __construct(
        EntityManagerInterface          $manager,
        RoomsCollectionFactoryInterface $roomsCollectionFactory
    )
    {
        $this->manager = $manager;
        $this->doctrineRepository = $this->manager->getRepository(RoomEntity::class);

        $this->roomsCollectionFactory = $roomsCollectionFactory;
    }

    public function getByApartmentId(ApartmentId $apartmentId): RoomsCollection
    {
        $result = $this->doctrineRepository->findBy(['apartmentId' => $apartmentId->value()]);

        return $this->roomsCollectionFactory->fromQuery($result);
    }

    public function saveCollection(RoomsCollection $collection): void
    {
        $rooms = $collection->all();

        foreach ($rooms as $room) {
            $this->save($room);
        }
    }

    public function save(Room $room): void
    {
        $this->manager->persist($room->getDto());
        $this->manager->flush();
    }

    public function removeCollection(RoomsCollection $roomsCollection): void
    {
        foreach ($roomsCollection->all() as $room) {
            $this->manager->remove($room->getDTO());
        }

        $this->manager->flush();
    }

    public function remove(Room $room): void
    {
             $this->manager->remove($room->getDTO());
             $this->manager->flush();
    }
}