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
class RemoveApartmentController extends AbstractController
{
    /**
     * @Route("/{id}", name="app_apartment_remove", methods={"DELETE"})
     */
    public function remove($id): JsonResponse
    {
        ApartmentFacade::instance()->removeApartmentByExposedId($id);

        return new JsonResponse([], JsonResponse::HTTP_NO_CONTENT);
    }
}