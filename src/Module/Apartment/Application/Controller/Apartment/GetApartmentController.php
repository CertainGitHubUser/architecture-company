<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\Controller\Apartment;

use App\Module\Apartment\Application\Facade\ApartmentFacade;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/v1/apartment")
 */
class GetApartmentController extends AbstractController
{
    /**
     * @Route("/{id}", name="app_apartment_get", methods={"GET"})
     */
    public function get($id): JsonResponse
    {
        $result = ApartmentFacade::instance()->getApartmentByExposedId($id);

        return new JsonResponse($result, JsonResponse::HTTP_OK);
    }
}