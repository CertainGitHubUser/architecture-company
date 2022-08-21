<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\Controller\Apartment;

use App\Module\Apartment\Application\Facade\ApartmentFacade;
use App\Module\Apartment\Domain\Model\Apartment\Exception\Repository\ApartmentWithExposedIdNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        try {
            $result = ApartmentFacade::instance()->getApartmentByExposedId($id);
        } catch (ApartmentWithExposedIdNotFoundException $e) {
            return new JsonResponse(['message' => $e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        }

        return new JsonResponse($result, JsonResponse::HTTP_OK);
    }
}