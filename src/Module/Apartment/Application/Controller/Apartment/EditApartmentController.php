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
class EditApartmentController extends AbstractController
{
    /**
     * @Route("/{id}", name="app_apartment_edit", methods={"PUT"})
     */
    public function edit(string $id, Request $request): JsonResponse
    {
        ApartmentFacade::instance()->editApartment($id, $request->toArray());

        return new JsonResponse([], JsonResponse::HTTP_OK);
    }
}