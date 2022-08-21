<?php
declare(strict_types=1);

namespace App\Module\Apartment\Infrastructure\Factory\Room;

use App\Module\Apartment\Application\DTO\Room\ApartmentRoomsRawDTO;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;
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

    public function fromQuery(array $items): RoomsCollection
    {
        $rooms = [];

        foreach ($items as $item) {
            $rooms[] = $this->roomFactory->fromEntity($item);
        }

        return new RoomsCollection($rooms);
    }

    public function fromCreateApartmentRawDTO(array $items): RoomsCollection
    {
        $rooms = [];

        foreach ($items as $item) {
            $rooms[] = $this->roomFactory->fromCreateApartmentRawDTO(new Square($item['square']), new RoomType($item['roomType']));
        }

        return new RoomsCollection($rooms);
    }

    public function fromArgs(ApartmentRoomsRawDTO $dto, ApartmentId $apartmentId): RoomsCollection
    {
        $rooms = [];

        foreach ($dto->rooms as $room) {
            $rooms[] = $this->roomFactory->fromArgs(
                $apartmentId,
                new Square($room->square),
                new RoomType($room->roomType)
            );
        }

        return new RoomsCollection($rooms);
    }
}