<?php

namespace App\Module\Apartment\Infrastructure\Factory\ApartmentAddress;

use App\Module\Apartment\Domain\Model\Address\AddressIdsCollection;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;
use App\Module\Apartment\Domain\Model\ApartmentAddress\ApartmentAddress;
use App\Module\Apartment\Domain\Model\ApartmentAddress\ApartmentAddressesCollection;
use App\Module\Apartment\Domain\Model\ApartmentAddress\Factory\ApartmentAddressesCollectionFactoryInterface;
use App\Module\Apartment\Domain\Model\ApartmentAddress\Factory\ApartmentAddressFactoryInterface;

final class ApartmentAddressesCollectionFactory implements ApartmentAddressesCollectionFactoryInterface
{
    private ApartmentAddressFactoryInterface $apartmentAddressFactory;

    public function __construct(ApartmentAddressFactoryInterface $apartmentAddressFactory)
    {
        $this->apartmentAddressFactory = $apartmentAddressFactory;
    }

    public function fromArgs(ApartmentId $apartmentId, AddressIdsCollection $addressIdsCollection): ApartmentAddressesCollection
    {
        /** @var ApartmentAddress[] $apartmentAddresses */
        $apartmentAddresses = [];

        foreach ($addressIdsCollection->getAll() as $addressId) {
            $apartmentAddresses[] = $this->apartmentAddressFactory->fromArgs($apartmentId, $addressId);
        }

        return new ApartmentAddressesCollection($apartmentAddresses);
    }
}