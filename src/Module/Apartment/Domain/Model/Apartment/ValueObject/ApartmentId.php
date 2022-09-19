<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Apartment\ValueObject;

use App\Module\Apartment\Domain\Model\Apartment\Exception\InvalidApartmentIdException;
use App\Module\Common\Domain\Exception\InvalidPrimaryKeyException;
use App\Module\Common\Domain\ValueObject\PrimaryKey;

final class ApartmentId extends PrimaryKey
{
    protected function validate($value): void
    {
        try {
            parent::validate($value);
        } catch (InvalidPrimaryKeyException $e) {
            throw new InvalidApartmentIdException($value);
        }
    }
}