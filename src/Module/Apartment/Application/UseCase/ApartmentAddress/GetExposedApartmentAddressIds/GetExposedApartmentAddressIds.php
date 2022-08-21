<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\UseCase\ApartmentAddress\GetExposedApartmentAddressIds;

use App\Module\Apartment\Domain\Model\Address\Repository\AddressRepositoryInterface;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;
use App\Module\Apartment\Domain\Model\ApartmentAddress\Repository\ApartmentAddressRepositoryInterface;
use App\Module\Common\Domain\ValueObject\UUIDsCollection;

final class GetExposedApartmentAddressIds
{
    private ApartmentAddressRepositoryInterface $apartmentAddressRepository;
    private AddressRepositoryInterface $addressRepository;

    public function __construct(
        ApartmentAddressRepositoryInterface $apartmentAddressRepository,
        AddressRepositoryInterface          $addressRepository
    )
    {
        $this->apartmentAddressRepository = $apartmentAddressRepository;
        $this->addressRepository = $addressRepository;
    }

    public function handle(ApartmentId $apartmentId): UUIDsCollection
    {
        $addressIds = $this->apartmentAddressRepository
            ->getByApartmentId($apartmentId)
            ->getAddressIdsByApartmentId($apartmentId);

        return $this->addressRepository->getExposedIdsByIds($addressIds);
    }
}