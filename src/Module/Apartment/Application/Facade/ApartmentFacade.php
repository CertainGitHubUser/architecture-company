<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\Facade;

use App\Module\Apartment\Application\DTO\Apartment\CreateApartmentRawDTO;
use App\Module\Apartment\Application\DTO\Apartment\EditApartmentRawDTO;
use App\Module\Apartment\Application\DTO\Room\ApartmentRoomsRawDTO;
use App\Module\Apartment\Application\DTO\Room\EditApartmentRoomsRawDTO;
use App\Module\Apartment\Application\UseCase\Apartment\CreateApartment\CreateApartmentRequest;
use App\Module\Apartment\Application\UseCase\Apartment\EditApartment\EditApartmentRequest;
use App\Module\Apartment\Application\UseCase\Apartment\RemoveApartment\RemoveApartmentRequest;
use App\Module\Apartment\Application\UseCase\ApartmentAddress\CreateApartmentAddress\CreateApartmentAddressesRequest;
use App\Module\Apartment\Application\UseCase\Room\CreateApartmentRooms\CreateApartmentRoomsRequest;
use App\Module\Apartment\Application\UseCase\Room\EditApartmentRooms\EditApartmentRoomsRequest;
use App\Module\Apartment\Domain\Model\Apartment\Apartment;
use App\Module\Apartment\Domain\Model\Apartment\Exception\Repository\ApartmentWithIdNotFoundException;
use App\Module\Apartment\Domain\Model\Apartment\Repository\ApartmentRepositoryInterface;
use App\Module\Apartment\Domain\Model\Apartment\ValueObject\ApartmentId;
use App\Module\Apartment\Domain\Model\ApartmentAddress\Repository\ApartmentAddressRepositoryInterface;
use App\Module\Apartment\Domain\Model\Room\Repository\RoomRepositoryInterface;
use App\Module\Apartment\Domain\Model\Room\RoomsCollection;
use App\Module\Common\Domain\Factory\UUIDsCollectionFactory;
use App\Module\Common\Domain\ValueObject\UUID;
use App\Module\Common\Domain\ValueObject\UUIDsCollection;
use Symfony\Component\HttpKernel\KernelInterface;

final class ApartmentFacade
{
    private KernelInterface $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public static function instance(): self
    {
        /** @var KernelInterface $app */
        global $app;

        return new self($app);
    }

    public function createApartment(array $apartmentData): void
    {
        $request = new CreateApartmentRequest(CreateApartmentRawDTO::fromArray($apartmentData));
        $service = $this->kernel->getContainer()->get('ac.apartment.use_case.apartment.create_apartment');

        $service->handle($request);
    }

    public function editApartment(string $exposedId, array $apartmentData): void
    {
        $request = new EditApartmentRequest(EditApartmentRawDTO::initialize($apartmentData), $exposedId);

        $service = $this->kernel->getContainer()->get('ac.apartment.use_case.apartment.edit_apartment');

        $service->handle($request);
    }

    public function getApartmentByExposedId(string $exposedId): Apartment
    {
        return $this->getApartmentRepository()->getByExposedId(new UUID($exposedId));
    }

    public function removeApartmentByExposedId(string $exposedId): void
    {
        $request = new RemoveApartmentRequest($exposedId);

        $service = $this->kernel->getContainer()->get('ac.apartment.use_case.apartment.remove_apartment');

        $service->handle($request);
    }

    /** @throws ApartmentWithIdNotFoundException */
    public function getApartment(int $apartmentId): Apartment
    {
        return $this->getApartmentRepository()->get(new ApartmentId($apartmentId));
    }

    public function hasApartmentWithId(int $apartmentId): bool
    {
        return $this->getApartmentRepository()->hasId(new ApartmentId($apartmentId));
    }

    public function createApartmentRooms(string $exposedApartmentId, array $rooms): void
    {
        $request = new CreateApartmentRoomsRequest(
            UUID::fromString($exposedApartmentId),
            ApartmentRoomsRawDTO::initialize($rooms)
        );

        $service = $this->kernel->getContainer()->get('ac.apartment.use_case.room.create_apartment_rooms');

        $service->handle($request);
    }

    public function editApartmentRooms(int $apartmentId, array $rooms)
    {
        $request = new EditApartmentRoomsRequest(
            new ApartmentId($apartmentId),
            EditApartmentRoomsRawDTO::initialize($rooms)
        );

        $service = $this->kernel->getContainer()->get('ac.apartment.use_case.room.edit_apartment_room');

        $service->handle($request);
    }

    public function getApartmentRoomsByApartmentId(int $apartmentId): RoomsCollection
    {
        return $this->getRoomRepository()->getByApartmentId(new ApartmentId($apartmentId));
    }

    public function createApartmentAddresses(string $exposedApartmentId, array $exposedAddressIds): void
    {
        $request = new CreateApartmentAddressesRequest(
            UUID::fromString($exposedApartmentId),
            UUIDsCollectionFactory::fromStringArray($exposedAddressIds)
        );

        $service = $this->kernel->getContainer()->get('ac.apartment.use_case.apartment_address.create_apartment_addresses');

        $service->handle($request);
    }

    public function getExposedApartmentAddressIds(int $apartmentId): UUIDsCollection
    {
        $service = $this->kernel->getContainer()->get('ac.apartment.use_case.apartment_address.get_exposed_address_ids');

        return $service->handle(new ApartmentId($apartmentId));
    }

    private function getApartmentRepository(): ApartmentRepositoryInterface
    {
        return $this->kernel->getContainer()->get('ac.apartment.repository.apartment');
    }

    private function getRoomRepository(): RoomRepositoryInterface
    {
        return $this->kernel->getContainer()->get('ac.apartment.repository.room');
    }

    private function getApartmentAddressRepository(): ApartmentAddressRepositoryInterface
    {
        return $this->kernel->getContainer()->get('ac.apartment.repository.apartment_address');
    }
}