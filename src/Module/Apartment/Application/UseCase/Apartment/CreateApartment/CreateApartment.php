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
        $apartment = $this->apartmentFactory->fromCreateApartmentRawDTO($request->getDTO());

        $this->transactionManager->transactional(function () use ($request, $apartment) {
            $this->apartmentRepository->save($apartment);

            ApartmentFacade::instance()->createApartmentRooms(
                $apartment->exposedId()->value(),
                $request->getDTO()->rooms
            );

            ApartmentFacade::instance()->createApartmentAddresses(
                $apartment->exposedId()->value(),
                $request->getDTO()->addresses
            );
        });
    }
}