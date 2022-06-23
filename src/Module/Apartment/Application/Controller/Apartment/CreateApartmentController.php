<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\Controller\Apartment;

use App\Module\Apartment\Application\Facade\ApartmentFacade;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/v1/apartment")
 */
class CreateApartmentController extends AbstractController
{
    /**
     * @Route("", name="app_apartment_create", methods={"POST"})
     */
    public function create(Request $request): JsonResponse
    {
        ApartmentFacade::instance()->createApartment($request->toArray());

        return new JsonResponse([], JsonResponse::HTTP_CREATED);
    }
}