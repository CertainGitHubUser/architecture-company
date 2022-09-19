<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\UseCase\Room\EditApartmentRooms;

use App\Module\Apartment\Application\DTO\Room\EditApartmentRoomsRawDTO;
use App\Module\Apartment\Domain\Model\Room\Repository\RoomRepositoryInterface;
use App\Module\Apartment\Domain\Model\Room\RoomsCollection;
use App\Module\Common\Domain\ValueObject\UUID;

final class EditApartmentRooms
{
    private RoomRepositoryInterface $repository;

    public function __construct(RoomRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(EditApartmentRoomsRequest $request): void
    {
        $roomsCollection = $this->repository->getByApartmentId($request->getApartmentId());

        $this->updateRoomsCollection($roomsCollection, $request->getDTO());

        $this->repository->saveCollection($roomsCollection);
    }

    private function updateRoomsCollection(RoomsCollection $roomsCollection, EditApartmentRoomsRawDTO $dto): void
    {
        foreach ($dto->rooms as $room) {
            $roomsCollection->getByExposedId(new UUID($room->exposedId))
                ->getDTO()
                ->update($room);
        }
    }
}