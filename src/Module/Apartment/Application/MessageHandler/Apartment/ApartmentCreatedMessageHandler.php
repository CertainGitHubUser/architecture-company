<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\MessageHandler\Apartment;

use App\Module\Apartment\Domain\Model\Apartment\Message\ApartmentCreatedMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class ApartmentCreatedMessageHandler implements MessageHandlerInterface
{
    public function __invoke(ApartmentCreatedMessage $message): void
    {
        /**
         * Here must be business logic smth like
         * call facade from module a, call facade from module b, do some processing, etc.
         * some logging;
         */
        print_r("Message was processed at:" . time() . $message->getContent() . "\r\n");
    }
}