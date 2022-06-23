<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Address\Exception;

use App\Module\Common\Domain\Exception\InvalidValueException;
use Throwable;

final class AddressesWithIdsNotFoundException extends \Exception implements InvalidValueException
{
    public function __construct($addressIds = "", $code = 0, Throwable $previous = null)
    {
        $message = "Not found addresses with the following Ids: '{$addressIds}'";

        parent::__construct($message, $code, $previous);
    }
}