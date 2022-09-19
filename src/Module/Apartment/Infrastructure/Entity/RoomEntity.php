<?php
declare(strict_types=1);

namespace App\Module\Apartment\Infrastructure\Entity;

use App\Module\Apartment\Application\DTO\Room\EditApartmentRoomRawDTO;
use App\Module\Apartment\Domain\Model\Apartment\ValueObject\ApartmentId;
use App\Module\Apartment\Domain\Model\Common\ValueObject\Square;
use App\Module\Apartment\Domain\Model\Room\RoomDTOInterface;
use App\Module\Apartment\Domain\Model\Room\ValueObject\RoomId;
use App\Module\Apartment\Domain\Model\Room\ValueObject\RoomType;
use App\Module\Common\Domain\ValueObject\UUID;
use App\Module\Common\Infrastructure\Entity\EntityTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="`room`")
 */
class RoomEntity implements RoomDTOInterface
{
    use EntityTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=36)
     */
    private $exposedId;

    /**
     * @ORM\Column(type="integer")
     */
    private $apartmentId;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $roomType;

    /**
     * @ORM\Column(type="integer")
     */
    private $square;

    public function getId(): RoomId
    {
        return RoomId::fromString($this->id);
    }

    public function setId($id): void
    {
        $this->id = RoomId::fromString($id)->value();
    }

    public function getExposedId(): UUID
    {
        return UUID::fromString($this->exposedId);
    }

    public function setExposedId($exposedId): void
    {
        $this->exposedId = UUID::fromString($exposedId)->value();
    }

    public function getApartmentId(): ApartmentId
    {
        return ApartmentId::fromString($this->apartmentId);
    }

    public function setApartmentId($apartmentId): void
    {
        $this->apartmentId = ApartmentId::fromString($apartmentId)->value();
    }

    public function getRoomType(): RoomType
    {
        return RoomType::fromString($this->roomType);
    }

    public function setRoomType($roomType): void
    {
        $this->roomType = RoomType::fromString($roomType)->value();
    }

    public function getSquare(): Square
    {
        return Square::fromString($this->square);
    }

    public function setSquare($square): void
    {
        $this->square = Square::fromString($square)->value();
    }

    public function update(EditApartmentRoomRawDTO $dto): void
    {
        $this->_update($dto);
    }
}