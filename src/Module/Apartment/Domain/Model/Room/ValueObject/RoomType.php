<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Room\ValueObject;

use App\Module\Apartment\Domain\Model\Room\Exception\InvalidRoomTypeException;
use App\Module\Common\Domain\ValueObject\AbstractValueObject;

final class RoomType extends AbstractValueObject
{
    public const ROOM_TYPE_LIVING_ROOM = 'LivingRoom';

    public const ROOM_TYPE_BEDROOM = 'Bedroom';

    public const ROOM_TYPE_KITCHEN = 'Kitchen';

    public const ROOM_TYPE_DINING_ROOM = 'DiningRoom';

    public const ROOM_TYPE_FAMILY_ROOM = 'FamilyRoom';

    public const ROOM_TYPE_GUEST_ROOM = 'GuestRoom';

    public const ROOM_TYPE_BATHROOM = 'Bathroom';

    public const ROOM_TYPE_GAME_ROOM = 'GameRoom';

    public const ROOM_TYPE_HOME_OFFICE = 'HomeOffice';

    public const ROOM_TYPE_NURSERY = 'Nursery';

    public const ROOM_TYPE_LIBRARY = 'Library';

    public const ROOM_TYPE_STORAGE = 'Storage';

    public const ROOM_TYPE_GYM = 'Gym';

    public const ROOM_TYPE_PANTRY = 'Pantry';

    public const ROOM_TYPE_LOFT = 'Loft';

    public const ROOM_TYPE_LAUNDRY = 'Laundry';

    public const ROOM_TYPES = [
        self::ROOM_TYPE_LIVING_ROOM,
        self::ROOM_TYPE_BEDROOM,
        self::ROOM_TYPE_KITCHEN,
        self::ROOM_TYPE_DINING_ROOM,
        self::ROOM_TYPE_FAMILY_ROOM,
        self::ROOM_TYPE_GUEST_ROOM,
        self::ROOM_TYPE_BATHROOM,
        self::ROOM_TYPE_GAME_ROOM,
        self::ROOM_TYPE_HOME_OFFICE,
        self::ROOM_TYPE_NURSERY,
        self::ROOM_TYPE_LIBRARY,
        self::ROOM_TYPE_STORAGE,
        self::ROOM_TYPE_GYM,
        self::ROOM_TYPE_PANTRY,
        self::ROOM_TYPE_LOFT,
        self::ROOM_TYPE_LAUNDRY,
    ];

    protected function initialConversion($value)
    {
        return (string)$value;
    }

    protected function validate($value): void
    {
        if (in_array($value, self::ROOM_TYPES) === false) {
            throw new InvalidRoomTypeException($value);
        }
    }
}