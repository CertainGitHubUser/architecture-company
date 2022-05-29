<?php
declare(strict_types=1);

namespace App\Controller;

use App\Messanger\SampleMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/v1/message")
 */
class RabbitMQProducerController extends AbstractController
{
    /**
     * @Route("/", name="app_message_index", methods={"GET"})
     */
    public function index(MessageBusInterface $bus): Response
    {
        $message = new SampleMessage('content');

        $bus->dispatch($message);

        return new Response(sprintf('Message with content %s was published', $message->getContent()));
    }
}