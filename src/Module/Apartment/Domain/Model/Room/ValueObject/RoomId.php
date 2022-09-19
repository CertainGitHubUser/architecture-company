<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Room\ValueObject;

use App\Module\Apartment\Domain\Model\Room\Exception\InvalidRoomIdException;
use App\Module\Common\Domain\Exception\InvalidPrimaryKeyException;
use App\Module\Common\Domain\ValueObject\PrimaryKey;

final class RoomId extends PrimaryKey
{
    protected function validate($value): void
    {
        try {
            parent::validate($value);
        } catch (InvalidPrimaryKeyException $e) {
            throw new InvalidRoomIdException($value);
        }
    }
}