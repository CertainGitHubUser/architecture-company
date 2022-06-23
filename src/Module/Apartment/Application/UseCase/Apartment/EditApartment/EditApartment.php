<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\UseCase\Apartment\EditApartment;

use App\Module\Apartment\Application\Facade\ApartmentFacade;
use App\Module\Apartment\Domain\Model\Apartment\Factory\ApartmentFactoryInterface;
use App\Module\Apartment\Domain\Model\Apartment\Repository\ApartmentRepositoryInterface;
use App\Module\Common\Domain\Repository\TransactionManagerInterface;

final class EditApartment
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

    public function handle(EditApartmentRequest $request): void
    {
        $this->transactionManager->transactional(function () use ($request) {
            $apartment = $this->apartmentRepository->getByExposedId($request->getExposedId());
            $apartment->getDTO()->update($request->getDTO());
            $this->apartmentRepository->save($apartment);

            ApartmentFacade::instance()->editApartmentRooms($apartment->id()->value(), $request->getDTO()->rooms);
        });
    }
}