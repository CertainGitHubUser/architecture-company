<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Apartment\Exception\Repository;

use App\Module\Common\Domain\Exception\InvalidValueException;
use Throwable;

final class ApartmentWithExposedIdNotFoundException extends \Exception implements InvalidValueException
{
    public function __construct($id = "", $code = 0, Throwable $previous = null)
    {
        $message = "apartment with exposed id not found: '{$id}'";

        parent::__construct($message, $code, $previous);
    }
}