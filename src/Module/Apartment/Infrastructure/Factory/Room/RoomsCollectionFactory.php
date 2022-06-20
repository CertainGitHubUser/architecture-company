<?php
declare(strict_types=1);

namespace App\Module\Apartment\Infrastructure\Factory\Room;

use App\Module\Apartment\Application\UseCase\Room\CreateRoomsCollection\CreateApartmentRoomsRequest;
use App\Module\Apartment\Domain\Model\Common\Square;
use App\Module\Apartment\Domain\Model\Room\Factory\RoomFactoryInterface;
use App\Module\Apartment\Domain\Model\Room\Factory\RoomsCollectionFactoryInterface;
use App\Module\Apartment\Domain\Model\Room\RoomsCollection;
use App\Module\Apartment\Domain\Model\Room\RoomType;

final class RoomsCollectionFactory implements RoomsCollectionFactoryInterface
{
    private RoomFactoryInterface $roomFactory;

    public function __construct(RoomFactoryInterface $roomFactory)
    {
        $this->roomFactory = $roomFactory;
    }

    public function fromCreateApartmentRoomsRequest(CreateApartmentRoomsRequest $request): RoomsCollection
    {
        $rooms = [];

        foreach ($request->getDTO()->rooms as $room) {
            $rooms[] = $this->roomFactory->fromArgs(
                $request->getApartmentId(),
                new Square($room->square),
                new RoomType($room->roomType)
            );
        }

        return new RoomsCollection($rooms);
    }
}