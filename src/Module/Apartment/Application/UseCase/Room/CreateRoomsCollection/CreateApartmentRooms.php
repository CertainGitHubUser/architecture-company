<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\UseCase\Room\CreateRoomsCollection;

use App\Module\Apartment\Application\Facade\ApartmentFacade;
use App\Module\Apartment\Domain\Model\Room\Factory\RoomsCollectionFactoryInterface;
use App\Module\Apartment\Domain\Model\Room\Repository\RoomRepositoryInterface;

final class CreateApartmentRooms
{
    private RoomsCollectionFactoryInterface $collectionFactory;

    private RoomRepositoryInterface $repository;

    public function __construct(RoomsCollectionFactoryInterface $collectionFactory, RoomRepositoryInterface $repository)
    {
        $this->collectionFactory = $collectionFactory;
        $this->repository = $repository;
    }

    public function handle(CreateApartmentRoomsRequest $request): void
    {
        ApartmentFacade::instance()->getApartment($request->getApartmentId()->value());
        $collection = $this->collectionFactory->fromCreateApartmentRoomsRequest($request);
        $this->repository->saveCollection($collection);
    }
}
