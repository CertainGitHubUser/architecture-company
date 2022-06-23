<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\UseCase\Apartment\CreateApartment;

use App\Module\Apartment\Application\Facade\ApartmentFacade;
use App\Module\Apartment\Domain\Model\Apartment\Factory\ApartmentFactoryInterface;
use App\Module\Apartment\Domain\Model\Apartment\Repository\ApartmentRepositoryInterface;
use App\Module\Common\Domain\Repository\TransactionManagerInterface;

final class CreateApartment
{
    private ApartmentRepositoryInterface $apartmentRepository;
    private ApartmentFactoryInterface $apartmentFactory;
    private TransactionManagerInterface $transactionManager;

    public function __construct(
        ApartmentRepositoryInterface $apartmentRepository,
        ApartmentFactoryInterface    $apartmentFactory,
        TransactionManagerInterface  $transactionManager
    )
    {
        $this->apartmentRepository = $apartmentRepository;
        $this->apartmentFactory = $apartmentFactory;
        $this->transactionManager = $transactionManager;
    }

    public function handle(CreateApartmentRequest $request): void
    {
        $this->transactionManager->transactional(function () use ($request) {
            $apartment = $this->apartmentFactory->fromApartmentRawDTO($request->getDTO());

            $this->apartmentRepository->save($apartment);

            $createdApartment = $this->apartmentRepository->getByExposedId($apartment->exposedId());

            ApartmentFacade::instance()->createApartmentRooms(
                $createdApartment->id()->value(),
                $request->getDTO()->rooms
            );

            ApartmentFacade::instance()->createApartmentAddresses(
                $createdApartment->id()->value(),
                $request->getDTO()->addresses
            );
        });
    }
}