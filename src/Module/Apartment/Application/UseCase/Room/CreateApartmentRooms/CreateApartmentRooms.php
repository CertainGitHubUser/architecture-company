<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\UseCase\Room\CreateApartmentRooms;

use App\Module\Apartment\Application\Exception\UseCase\Room\InvalidApartmentSquareException;
use App\Module\Apartment\Domain\Model\Apartment\Repository\ApartmentRepositoryInterface;
use App\Module\Apartment\Domain\Model\Room\Factory\RoomsCollectionFactoryInterface;
use App\Module\Apartment\Domain\Model\Room\Repository\RoomRepositoryInterface;

final class CreateApartmentRooms
{
    private RoomsCollectionFactoryInterface $collectionFactory;

    private RoomRepositoryInterface $roomRepository;

    private ApartmentRepositoryInterface $apartmentRepository;

    public function __construct(
        ApartmentRepositoryInterface    $apartmentRepository,
        RoomsCollectionFactoryInterface $collectionFactory,
        RoomRepositoryInterface         $roomRepository
    )
    {
        $this->apartmentRepository = $apartmentRepository;
        $this->collectionFactory = $collectionFactory;
        $this->roomRepository = $roomRepository;
    }

    public function handle(CreateApartmentRoomsRequest $request): void
    {
        $apartment = $this->apartmentRepository->getByExposedId($request->getExposedApartmentId());
        $collection = $this->collectionFactory->fromArgs($request->getDTO(), $apartment->id());

        $apartmentSquare = $apartment->square()->value();
        $roomsSquare = $collection->countTotalSquare()->value();

        if ($apartmentSquare < $roomsSquare) {
            throw new InvalidApartmentSquareException($apartmentSquare, $roomsSquare);
        }

        $this->roomRepository->saveCollection($collection);
    }
}
