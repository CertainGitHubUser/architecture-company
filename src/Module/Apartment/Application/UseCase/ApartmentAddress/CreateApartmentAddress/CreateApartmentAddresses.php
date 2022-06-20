<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\UseCase\ApartmentAddress\CreateApartmentAddress;

use App\Module\Apartment\Domain\Model\Address\Factory\AddressIdsCollectionFactoryInterface;
use App\Module\Apartment\Domain\Model\Address\Repository\AddressRepositoryInterface;
use App\Module\Apartment\Domain\Model\Apartment\Exception\Repository\ApartmentWithIdNotFoundException;
use App\Module\Apartment\Domain\Model\Apartment\Repository\ApartmentRepositoryInterface;
use App\Module\Apartment\Domain\Model\ApartmentAddress\Factory\ApartmentAddressesCollectionFactoryInterface;
use App\Module\Apartment\Domain\Model\ApartmentAddress\Repository\ApartmentAddressRepositoryInterface;

final class CreateApartmentAddresses
{
    private ApartmentAddressRepositoryInterface $apartmentAddressRepository;

    private ApartmentRepositoryInterface $apartmentRepository;

    private AddressRepositoryInterface $addressRepository;

    private ApartmentAddressesCollectionFactoryInterface $collectionFactory;

    private AddressIdsCollectionFactoryInterface $addressIdsCollectionFactory;

    public function __construct(
        ApartmentAddressRepositoryInterface          $apartmentAddressRepository,
        ApartmentRepositoryInterface                 $apartmentRepository,
        AddressRepositoryInterface                   $addressRepository,
        ApartmentAddressesCollectionFactoryInterface $collectionFactory,
        AddressIdsCollectionFactoryInterface         $addressIdsCollectionFactory
    )
    {
        $this->apartmentAddressRepository = $apartmentAddressRepository;
        $this->apartmentRepository = $apartmentRepository;
        $this->addressRepository = $addressRepository;
        $this->collectionFactory = $collectionFactory;
        $this->addressIdsCollectionFactory = $addressIdsCollectionFactory;
    }

    public function handle(CreateApartmentAddressesRequest $request): void
    {
        if (!$this->apartmentRepository->hasId($request->getApartmentId())) {
            throw new ApartmentWithIdNotFoundException($request->getApartmentId());
        }

        $addressIdsCollection = $this->addressRepository->getIdsByExposedIds($request->getExposedAddressIds());
        $collection = $this->collectionFactory->fromArgs($request->getApartmentId(), $addressIdsCollection);

        $this->apartmentAddressRepository->saveCollection($collection);
    }
}