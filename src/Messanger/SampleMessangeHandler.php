<?php
declare(strict_types=1);

namespace App\Messanger;

use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class SampleMessangeHandler implements MessageHandlerInterface
{
    public function __invoke(SampleMessage $message)
    {
        print_r("Message was handled at:".time()."\r\n");
    }
}