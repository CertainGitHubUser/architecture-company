<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\Facade;

use App\Module\Apartment\Application\DTO\Apartment\CreateApartmentRawDTO;
use App\Module\Apartment\Application\DTO\Room\CreateApartmentRoomsRawDTO;
use App\Module\Apartment\Application\UseCase\Apartment\CreateApartment\CreateApartmentRequest;
use App\Module\Apartment\Application\UseCase\ApartmentAddress\CreateApartmentAddress\CreateApartmentAddressesRequest;
use App\Module\Apartment\Application\UseCase\Room\CreateRoomsCollection\CreateApartmentRoomsRequest;
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
        $request = new CreateApartmentRequest(CreateApartmentRawDTO::initialize($apartmentData));

        $service = $this->kernel->getContainer()->get('ac.apartment.use_case.apartment.create_apartment');

        $service->handle($request);
    }

    /** @throws ApartmentWithIdNotFoundException */
    public function getApartment(int $apartmentId): Apartment
    {
        return $this->getApartmentRepository()->get(new ApartmentId($apartmentId));
    }

    public function createApartmentRooms(int $apartmentId, array $rooms)
    {
        $request = new CreateApartmentRoomsRequest(
            new ApartmentId($apartmentId),
            CreateApartmentRoomsRawDTO::initialize($rooms)
        );

        $service = $this->kernel->getContainer()->get('ac.apartment.use_case.room.create_apartment_room');

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