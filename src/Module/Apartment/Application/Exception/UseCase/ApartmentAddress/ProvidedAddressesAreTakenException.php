<?php
declare(strict_types=1);

namespace App\Module\Apartment\Application\Exception\UseCase\ApartmentAddress;

use App\Module\Common\Domain\Exception\InvalidValueException;
use Throwable;

final class ProvidedAddressesAreTakenException extends \Exception implements InvalidValueException
{
    public function __construct( $code = 0, Throwable $previous = null)
    {
        parent::__construct('Provided addresses are already taken', $code, $previous);
    }
}