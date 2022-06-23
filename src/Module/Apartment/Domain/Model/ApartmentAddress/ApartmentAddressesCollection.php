<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\ApartmentAddress;

use App\Module\Apartment\Domain\Model\Address\AddressId;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;

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

    /** @return AddressId[] */
    public function getAddressIdsByApartmentId(ApartmentId $apartmentId): array
    {
        $apartmentAddresses = $this->getByApartmentId($apartmentId);
        $addressIds = [];

        foreach ($apartmentAddresses as $apartmentAddress) {
            $addressIds[] = $apartmentAddress->addressId();
        }

        return $addressIds;
    }

    private function makeApartmentIdMap(): void
    {
        $this->apartmentIdMap = [];

        foreach ($this->apartmentAddresses as $apartmentAddress) {
            $this->apartmentIdMap[$apartmentAddress->getDTO()->getApartmentId()->value()][] = $apartmentAddress;
        }
    }
}