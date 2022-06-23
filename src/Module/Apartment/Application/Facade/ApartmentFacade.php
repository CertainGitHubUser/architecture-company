<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\Facade;

use App\Module\Apartment\Application\DTO\Apartment\ApartmentRawDTO;
use App\Module\Apartment\Application\DTO\Room\ApartmentRoomsRawDTO;
use App\Module\Apartment\Application\DTO\Room\EditApartmentRoomsRawDTO;
use App\Module\Apartment\Application\UseCase\Apartment\CreateApartment\CreateApartmentRequest;
use App\Module\Apartment\Application\UseCase\Apartment\EditApartment\EditApartmentRequest;
use App\Module\Apartment\Application\UseCase\Apartment\GetApartment\GetApartmentRequest;
use App\Module\Apartment\Application\UseCase\Apartment\RemoveApartment\RemoveApartmentRequest;
use App\Module\Apartment\Application\UseCase\ApartmentAddress\CreateApartmentAddress\CreateApartmentAddressesRequest;
use App\Module\Apartment\Application\UseCase\Room\CreateApartmentRooms\CreateApartmentRoomsRequest;
use App\Module\Apartment\Application\UseCase\Room\EditApartmentRooms\EditApartmentRoomsRequest;
use App\Module\Apartment\Domain\Model\Apartment\Apartment;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;
use App\Module\Apartment\Domain\Model\Apartment\Exception\Repository\ApartmentWithIdNotFoundException;
use App\Module\Apartment\Domain\Model\Apartment\Repository\ApartmentRepositoryInterface;
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
        global $app;

        return new self($app);
    }

    public function createApartment(array $apartmentData)
    {
        $request = new CreateApartmentRequest(ApartmentRawDTO::initialize($apartmentData));

        $service = $this->kernel->getContainer()->get('ac.apartment.use_case.apartment.create_apartment');

        $service->handle($request);
    }

    public function editApartment(string $exposedId, array $apartmentData): void
    {
        $request = new EditApartmentRequest(ApartmentRawDTO::initialize($apartmentData), $exposedId);

        $service = $this->kernel->getContainer()->get('ac.apartment.use_case.apartment.edit_apartment');

        $service->handle($request);
    }

    public function getApartmentByExposedId(string $exposedId): Apartment
    {
        $request = new GetApartmentRequest($exposedId);

        $service = $this->kernel->getContainer()->get('ac.apartment.use_case.apartment.get_apartment');

        return $service->handle($request);
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

    public function createApartmentRooms(int $apartmentId, array $rooms)
    {
        $request = new CreateApartmentRoomsRequest(
            new ApartmentId($apartmentId),
            ApartmentRoomsRawDTO::initialize($rooms)
        );

        $service = $this->kernel->getContainer()->get('ac.apartment.use_case.room.create_apartment_room');

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

    public function createApartmentAddresses(int $apartmentId, array $exposedAddressIds): void
    {
        $request = new CreateApartmentAddressesRequest($apartmentId, $exposedAddressIds);

        $service = $this->kernel->getContainer()->get('ac.apartment.use_case.apartment_address.create_apartment_addresses');

        $service->handle($request);
    }

    private function getApartmentRepository(): ApartmentRepositoryInterface
    {
        return $this->kernel->getContainer()->get('ac.apartment.repository.apartment_repository');
    }
}