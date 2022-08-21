<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\UseCase\ApartmentAddress\CreateApartmentAddress;

use App\Module\Apartment\Application\Exception\UseCase\ApartmentAddress\InvalidAddressesAmountException;
use App\Module\Apartment\Application\Exception\UseCase\ApartmentAddress\ProvidedAddressesAreTakenException;
use App\Module\Apartment\Domain\Model\Address\Repository\AddressRepositoryInterface;
use App\Module\Apartment\Domain\Model\Apartment\Repository\ApartmentRepositoryInterface;
use App\Module\Apartment\Domain\Model\ApartmentAddress\Factory\ApartmentAddressesCollectionFactoryInterface;
use App\Module\Apartment\Domain\Model\ApartmentAddress\Repository\ApartmentAddressRepositoryInterface;

final class CreateApartmentAddresses
{
    private ApartmentAddressRepositoryInterface $apartmentAddressRepository;

    private ApartmentRepositoryInterface $apartmentRepository;

    private AddressRepositoryInterface $addressRepository;

    private ApartmentAddressesCollectionFactoryInterface $apartmentAddressesCollectionFactory;

    public function __construct(
        ApartmentAddressRepositoryInterface          $apartmentAddressRepository,
        ApartmentRepositoryInterface                 $apartmentRepository,
        AddressRepositoryInterface                   $addressRepository,
        ApartmentAddressesCollectionFactoryInterface $apartmentAddressesCollectionFactory
    )
    {
        $this->apartmentAddressRepository = $apartmentAddressRepository;
        $this->apartmentRepository = $apartmentRepository;
        $this->addressRepository = $addressRepository;
        $this->apartmentAddressesCollectionFactory = $apartmentAddressesCollectionFactory;
    }

    public function handle(CreateApartmentAddressesRequest $request): void
    {
        $addressesAmount = $request->getExposedAddressIds()->count()->value();

        if ($addressesAmount > 4 || $addressesAmount < 1) {
            throw new InvalidAddressesAmountException($addressesAmount);
        }

        $apartmentId = $this->apartmentRepository->getIdByExposedId($request->getExposedApartmentId());
        $addressIdsCollection = $this->addressRepository->getIdsByExposedIds($request->getExposedAddressIds());

        $apartmentAddressesCollection = $this->apartmentAddressesCollectionFactory->fromArgs($apartmentId, $addressIdsCollection);

        if (!$this->apartmentAddressRepository->addressesAreAvailable($apartmentAddressesCollection)) {
            throw new ProvidedAddressesAreTakenException();
        }

        $this->apartmentAddressRepository->saveCollection($apartmentAddressesCollection);
    }
}