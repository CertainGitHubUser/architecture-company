<?php

namespace App\Module\Apartment\Domain\Model\Room\Factory;

use App\Module\Apartment\Application\UseCase\Room\CreateRoomsCollection\CreateApartmentRoomsRequest;
use App\Module\Apartment\Domain\Model\Room\RoomsCollection;

interface RoomsCollectionFactoryInterface
{
    public function fromCreateApartmentRoomsRequest(CreateApartmentRoomsRequest $request): RoomsCollection;
}