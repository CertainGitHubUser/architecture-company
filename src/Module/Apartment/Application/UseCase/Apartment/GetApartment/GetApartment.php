<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\UseCase\Apartment\GetApartment;

use App\Module\Apartment\Domain\Model\Address\Factory\AddressIdsCollectionFactoryInterface;
use App\Module\Apartment\Domain\Model\Address\Repository\AddressRepositoryInterface;
use App\Module\Apartment\Domain\Model\Apartment\Apartment;
use App\Module\Apartment\Domain\Model\Apartment\Repository\ApartmentRepositoryInterface;
use App\Module\Apartment\Domain\Model\ApartmentAddress\Repository\ApartmentAddressRepositoryInterface;
use App\Module\Apartment\Domain\Model\Room\Repository\RoomRepositoryInterface;

final class GetApartment
{
    private ApartmentRepositoryInterface $apartmentRepository;
    private RoomRepositoryInterface $roomRepository;
    private ApartmentAddressRepositoryInterface $apartmentAddressRepository;
    private AddressRepositoryInterface $addressRepository;
    private AddressIdsCollectionFactoryInterface $addressIdsCollectionFactory;

    public function __construct(
        ApartmentRepositoryInterface         $apartmentRepository,
        ApartmentAddressRepositoryInterface  $apartmentAddressRepository,
        AddressRepositoryInterface           $addressRepository,
        AddressIdsCollectionFactoryInterface $addressIdsCollectionFactory,
        RoomRepositoryInterface              $roomRepository
    )
    {
        $this->apartmentRepository = $apartmentRepository;
        $this->apartmentAddressRepository = $apartmentAddressRepository;
        $this->addressRepository = $addressRepository;
        $this->addressIdsCollectionFactory = $addressIdsCollectionFactory;
        $this->roomRepository = $roomRepository;
    }

    public function handle(GetApartmentRequest $request): Apartment
    {
        $apartment = $this->apartmentRepository->getByExposedId($request->getUUID());
        $addressIds = $this->apartmentAddressRepository
            ->getByApartmentId($apartment->id())
            ->getAddressIdsByApartmentId($apartment->id());

        $addressIdsCollection = $this->addressIdsCollectionFactory->fromList($addressIds);
        $exposedAddressIds = $this->addressRepository->getExposedIdsByIds($addressIdsCollection);
        $rooms = $this->roomRepository->getByApartmentId($apartment->id());

        $apartment->getDTO()->addExposedAddressIds($exposedAddressIds);
        $apartment->getDTO()->addRooms($rooms);

        return $apartment;
    }
}