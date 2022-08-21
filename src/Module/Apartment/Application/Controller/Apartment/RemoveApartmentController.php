<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\Controller\Apartment;

use App\Module\Apartment\Application\Facade\ApartmentFacade;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
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
        try {
            ApartmentFacade::instance()->removeApartmentByExposedId($id);
        } catch (\Throwable $e) {
            throw new BadRequestException($e->getMessage(), JsonResponse::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([], JsonResponse::HTTP_NO_CONTENT);
    }
}