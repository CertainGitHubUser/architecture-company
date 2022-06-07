<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Address\Exception;

use App\Module\Common\Domain\Exception\InvalidValueException;
use Throwable;

final class InvalidLatitudeException extends \Exception implements InvalidValueException
{
    public function __construct($latitude = "", $code = 0, Throwable $previous = null)
    {
        $message = "invalid latitude: '{$latitude}'";

        parent::__construct($message, $code, $previous);
    }
}