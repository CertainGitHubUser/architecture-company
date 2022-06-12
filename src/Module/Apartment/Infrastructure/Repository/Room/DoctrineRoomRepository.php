<?php
declare(strict_types=1);

namespace App\Module\Apartment\Infrastructure\Repository\Room;

use App\Module\Apartment\Domain\Model\Room\Factory\RoomFactoryInterface;
use App\Module\Apartment\Domain\Model\Room\Factory\RoomsCollectionFactoryInterface;
use App\Module\Apartment\Domain\Model\Room\Repository\RoomRepositoryInterface;
use App\Module\Apartment\Domain\Model\Room\Room;
use App\Module\Apartment\Infrastructure\Entity\RoomEntity;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

final class DoctrineRoomRepository implements RoomRepositoryInterface
{
    private EntityManagerInterface $manager;
    private ObjectRepository $doctrineRepository;

    private RoomFactoryInterface $roomFactory;
    private RoomsCollectionFactoryInterface $roomsCollectionFactory;

    public function __construct(
        EntityManagerInterface $manager,
        RoomFactoryInterface $roomFactory,
        RoomsCollectionFactoryInterface $roomsCollectionFactory
    )
    {
        $this->manager = $manager;
        $this->doctrineRepository = $this->manager->getRepository(RoomEntity::class);

        $this->roomFactory = $roomFactory;
        $this->roomsCollectionFactory = $roomsCollectionFactory;
    }

    public function save(Room $room): void
    {
        $this->manager->persist($room->getDto());
        $this->manager->flush();
    }
}