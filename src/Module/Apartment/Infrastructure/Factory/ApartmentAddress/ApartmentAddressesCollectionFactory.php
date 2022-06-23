<?php

namespace App\Module\Apartment\Infrastructure\Factory\ApartmentAddress;

use App\Module\Apartment\Domain\Model\Address\AddressIdsCollection;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;
use App\Module\Apartment\Domain\Model\ApartmentAddress\ApartmentAddress;
use App\Module\Apartment\Domain\Model\ApartmentAddress\ApartmentAddressesCollection;
use App\Module\Apartment\Domain\Model\ApartmentAddress\Factory\ApartmentAddressesCollectionFactoryInterface;
use App\Module\Apartment\Domain\Model\ApartmentAddress\Factory\ApartmentAddressFactoryInterface;
use App\Module\Apartment\Infrastructure\Entity\ApartmentAddressEntity;

final class ApartmentAddressesCollectionFactory implements ApartmentAddressesCollectionFactoryInterface
{
    private ApartmentAddressFactoryInterface $apartmentAddressFactory;

    public function __construct(ApartmentAddressFactoryInterface $apartmentAddressFactory)
    {
        $this->apartmentAddressFactory = $apartmentAddressFactory;
    }

    /** @param ApartmentAddressEntity[] $items */
    public function fromQuery(array $items): ApartmentAddressesCollection
    {
        /** @var ApartmentAddress[] $apartmentAddresses */
        $apartmentAddresses = [];

        foreach ($items as $item) {
            $apartmentAddresses[] = $this->apartmentAddressFactory->fromEntity($item);
        }

        return new ApartmentAddressesCollection($apartmentAddresses);
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