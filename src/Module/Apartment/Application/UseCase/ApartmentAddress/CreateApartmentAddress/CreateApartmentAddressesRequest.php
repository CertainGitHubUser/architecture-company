<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\UseCase\ApartmentAddress\CreateApartmentAddress;

use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;
use App\Module\Common\Domain\ValueObject\UUID;
use App\Module\Common\Domain\ValueObject\UUIDsCollection;

final class CreateApartmentAddressesRequest
{
    private ApartmentId $apartmentId;

    /** @var UUIDsCollection */
    private UUIDsCollection $exposedAddressIds;

    public function __construct(int $apartmentId, array $exposedAddressIds)
    {
        $this->apartmentId = new ApartmentId($apartmentId);
        $UUIDs = [];
        //TODO make static uuids collection factory
        foreach ($exposedAddressIds as $exposedAddressId) {
            $UUIDs[] = new UUID($exposedAddressId);
        }

        $this->exposedAddressIds = new UUIDsCollection($UUIDs);
    }

    public function getApartmentId(): ApartmentId
    {
        return $this->apartmentId;
    }

    public function getExposedAddressIds(): UUIDsCollection
    {
        return $this->exposedAddressIds;
    }
}