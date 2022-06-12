<?php

namespace App\Module\Common\Application\EventListener\KernelException;

use App\Module\Common\Domain\Exception\NotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

final class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        $response = new JsonResponse(['code' => $exception->getCode(), 'message' => $exception->getMessage()]);

        if ($exception instanceof NotFoundException) {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        } else {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        $event->setResponse($response);
    }
}