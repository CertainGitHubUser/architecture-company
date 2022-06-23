<?php

namespace App\Module\Apartment\Domain\Model\Room\Factory;

use App\Module\Apartment\Application\UseCase\Room\CreateApartmentRooms\CreateApartmentRoomsRequest;
use App\Module\Apartment\Domain\Model\Room\RoomsCollection;

interface RoomsCollectionFactoryInterface
{
    public function fromQuery(array $items): RoomsCollection;

    public function fromCreateApartmentRoomsRequest(CreateApartmentRoomsRequest $request): RoomsCollection;
}