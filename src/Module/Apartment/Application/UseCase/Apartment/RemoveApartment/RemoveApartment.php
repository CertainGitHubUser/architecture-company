<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\UseCase\Apartment\RemoveApartment;

use App\Module\Apartment\Domain\Model\Apartment\Repository\ApartmentRepositoryInterface;
use App\Module\Apartment\Domain\Model\ApartmentAddress\Repository\ApartmentAddressRepositoryInterface;
use App\Module\Apartment\Domain\Model\Room\Repository\RoomRepositoryInterface;
use App\Module\Common\Domain\Repository\TransactionManagerInterface;

final class RemoveApartment
{
    private ApartmentRepositoryInterface $apartmentRepository;
    private RoomRepositoryInterface $roomRepository;
    private TransactionManagerInterface $transactionManager;
    private ApartmentAddressRepositoryInterface $apartmentAddressRepository;

    public function __construct(
        ApartmentRepositoryInterface        $apartmentRepository,
        ApartmentAddressRepositoryInterface $apartmentAddressRepository,
        RoomRepositoryInterface             $roomRepository,
        TransactionManagerInterface         $transactionManager
    )
    {
        $this->apartmentRepository = $apartmentRepository;
        $this->apartmentAddressRepository = $apartmentAddressRepository;
        $this->roomRepository = $roomRepository;
        $this->transactionManager = $transactionManager;
    }

    public function handle(RemoveApartmentRequest $request): void
    {
        $apartment = $this->apartmentRepository->getByExposedId($request->getUUID());
        $apartmentAddresses = $this->apartmentAddressRepository->getByApartmentId($apartment->id());
        $rooms = $this->roomRepository->getByApartmentId($apartment->id());

        $this->transactionManager->transactional(function () use ($apartment, $apartmentAddresses, $rooms) {
            $this->apartmentRepository->remove($apartment);
            $this->apartmentAddressRepository->removeCollection($apartmentAddresses);
            $this->roomRepository->removeCollection($rooms);
        });
    }
}