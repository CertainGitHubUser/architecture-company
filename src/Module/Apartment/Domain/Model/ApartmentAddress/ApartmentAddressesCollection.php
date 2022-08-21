<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\ApartmentAddress;

use App\Module\Apartment\Domain\Model\Address\AddressIdsCollection;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;
use App\Module\Apartment\Infrastructure\Factory\Address\AddressIdsCollectionFactory;

final class ApartmentAddressesCollection
{
    /** @var ApartmentAddress[] */
    public array $apartmentAddresses;

    /**
     * @var array <ApartmentId, ApartmentAddress[]>
     */
    public array $apartmentIdMap;

    public function __construct(array $apartmentAddresses)
    {
        $this->apartmentAddresses = $apartmentAddresses;
        $this->makeApartmentIdMap();
    }

    public function all(): array
    {
        return $this->apartmentAddresses;
    }

    /** @return  ApartmentAddress[] */
    public function getByApartmentId(ApartmentId $apartmentId): array
    {
        return $this->apartmentIdMap[$apartmentId->value()];
    }

    public function getAddressIdsByApartmentId(ApartmentId $apartmentId): AddressIdsCollection
    {
        $apartmentAddresses = $this->getByApartmentId($apartmentId);
        $addressIds = [];

        foreach ($apartmentAddresses as $apartmentAddress) {
            $addressIds[] = $apartmentAddress->addressId();
        }

        return AddressIdsCollectionFactory::fromList($addressIds);
    }

    public function getAllAddressIdsAsStringArray(): array
    {
        $result = [];

        foreach ($this->apartmentAddresses as $apartmentAddress) {
            $result[] = $apartmentAddress->addressId()->value();
        }

        return $result;
    }

    private function makeApartmentIdMap(): void
    {
        $this->apartmentIdMap = [];

        foreach ($this->apartmentAddresses as $apartmentAddress) {
            $this->apartmentIdMap[$apartmentAddress->getDTO()->getApartmentId()->value()][] = $apartmentAddress;
        }
    }
}