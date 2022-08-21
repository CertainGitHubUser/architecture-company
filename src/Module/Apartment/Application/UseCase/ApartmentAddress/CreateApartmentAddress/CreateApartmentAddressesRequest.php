<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\UseCase\ApartmentAddress\CreateApartmentAddress;

use App\Module\Common\Domain\ValueObject\UUID;
use App\Module\Common\Domain\ValueObject\UUIDsCollection;

final class CreateApartmentAddressesRequest
{
    private UUID $exposedApartmentId;

    /** @var UUIDsCollection */
    private UUIDsCollection $exposedAddressIds;

    public function __construct(UUID $exposedApartmentId, UUIDsCollection $exposedAddressIds)
    {
        $this->exposedApartmentId = $exposedApartmentId;
        $this->exposedAddressIds = $exposedAddressIds;
    }

    public function getExposedApartmentId(): UUID
    {
        return $this->exposedApartmentId;
    }

    public function getExposedAddressIds(): UUIDsCollection
    {
        return $this->exposedAddressIds;
    }
}