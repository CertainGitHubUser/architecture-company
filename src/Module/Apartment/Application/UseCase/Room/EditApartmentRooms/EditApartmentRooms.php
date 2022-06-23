<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\UseCase\Room\EditApartmentRooms;

use App\Module\Apartment\Application\DTO\Room\EditApartmentRoomsRawDTO;
use App\Module\Apartment\Application\Facade\ApartmentFacade;
use App\Module\Apartment\Domain\Model\Room\Factory\RoomsCollectionFactoryInterface;
use App\Module\Apartment\Domain\Model\Room\Repository\RoomRepositoryInterface;
use App\Module\Apartment\Domain\Model\Room\RoomsCollection;
use App\Module\Common\Domain\ValueObject\UUID;

final class EditApartmentRooms
{
    private RoomsCollectionFactoryInterface $collectionFactory;

    private RoomRepositoryInterface $repository;

    public function __construct(RoomsCollectionFactoryInterface $collectionFactory, RoomRepositoryInterface $repository)
    {
        $this->collectionFactory = $collectionFactory;
        $this->repository = $repository;
    }

    public function handle(EditApartmentRoomsRequest $request): void
    {
        //TODO remove this validation
        if (!ApartmentFacade::instance()->hasApartmentWithId($request->getApartmentId()->value())) {
            throw new \Exception('EditApartmentRooms adjust exception.');
        }

        $roomsCollection = $this->repository->getByApartmentId($request->getApartmentId());

        $this->updateRoomsCollection($roomsCollection, $request->getDTO());

        $this->repository->saveCollection($roomsCollection);
    }

    private function updateRoomsCollection(RoomsCollection $roomsCollection, EditApartmentRoomsRawDTO $dto): void
    {
        foreach ($dto->rooms as $editModel) {
            $roomsCollection->getByExposedId(new UUID($editModel->exposedId))
                ->getDTO()
                ->update($editModel);
        }
    }
}