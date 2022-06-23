<?php
declare(strict_types=1);

namespace App\Module\Apartment\Infrastructure\Entity;

use App\Module\Apartment\Application\DTO\Apartment\ApartmentRawDTO;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentDTOInterface;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentType;
use App\Module\Apartment\Domain\Model\Apartment\HeatingType;
use App\Module\Apartment\Domain\Model\Common\Square;
use App\Module\Apartment\Domain\Model\Room\RoomsCollection;
use App\Module\Common\Domain\ValueObject\UnsignedInt;
use App\Module\Common\Domain\ValueObject\UUID;
use App\Module\Common\Domain\ValueObject\UUIDsCollection;
use App\Module\Common\Infrastructure\Entity\EntityTrait;
use App\Module\Price\Domain\Model\Currency\Currency;
use App\Module\Price\Domain\Model\Price\Price;
use App\Module\User\Domain\Model\User\UserId;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="`apartment`")
 */
class ApartmentEntity implements ApartmentDTOInterface
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
    private $userId;

    /**
     * @ORM\Column(type="float")
     */
    private $square;

    /**
     * @ORM\Column(type="integer")
     */
    private $floor;

    /**
     * @ORM\Column(type="date_immutable")
     */
    private $builtIn;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $apartmentType;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $heatingType;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rentalPrice;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $currency;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasGas;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasWater;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasHood;

    private UUIDsCollection $exposedAddressIds;

    private RoomsCollection $rooms;

    public function __construct(ApartmentRawDTO $rawDTO)
    {
        $this->_initialize($rawDTO);
    }

    public function update(ApartmentRawDTO $dto): void
    {
        $this->_update($dto);
    }

    public function getId(): ApartmentId
    {
        return ApartmentId::fromString($this->id);
    }

    public function setId($id): void
    {
        $this->id = ApartmentId::fromString($id)->value();
    }

    public function getExposedId(): UUID
    {
        return UUID::fromString($this->exposedId);
    }

    public function setExposedId($exposedId): void
    {
        $this->exposedId = UUID::fromString($exposedId)->value();
    }

    public function getSquare(): Square
    {
        return Square::fromString($this->square);
    }

    public function setSquare($square): void
    {
        $this->square = Square::fromString($square)->value();
    }

    public function getFloor(): UnsignedInt
    {
        return UnsignedInt::fromString($this->floor);
    }

    public function setFloor($floor): void
    {
        $this->floor = UnsignedInt::fromString($floor)->value();
    }

    public function getBuiltIn(): \DateTimeImmutable
    {
        return $this->builtIn;
    }

    public function setBuiltIn($builtIn): void
    {
        $this->builtIn = new \DateTimeImmutable();
    }

    public function getRooms(): RoomsCollection
    {
        return $this->rooms;
    }

    public function addRooms(RoomsCollection $roomsCollection): void
    {
        $this->rooms = $roomsCollection;
    }

    public function getUserId(): UserId
    {
        return UserId::fromString($this->userId);
    }

    public function setUserId($userId): void
    {
        $this->userId = UserId::fromString($userId)->value();
    }

    public function getPrice(): Price
    {
        return Price::fromString($this->price);
    }

    public function setPrice($price): void
    {
        $this->price = Price::fromString($price)->value();
    }

    public function getApartmentType(): ApartmentType
    {
        return ApartmentType::fromString($this->apartmentType);
    }

    public function setApartmentType($apartmentType): void
    {
        $this->apartmentType = ApartmentType::fromString($apartmentType)->value();
    }

    public function getHeatingType(): HeatingType
    {
        return HeatingType::fromString($this->heatingType);
    }

    public function setHeatingType($heatingType): void
    {
        $this->heatingType = HeatingType::fromString($heatingType)->value();
    }

    public function getRentalPrice(): ?Price
    {
        return Price::fromString($this->rentalPrice);
    }

    public function setRentalPrice($price = null): void
    {
        $this->rentalPrice = Price::fromString($price)->value();
    }

    public function getCurrency(): Currency
    {
        return Currency::fromString($this->currency);
    }

    public function setCurrency($currency): void
    {
        $this->currency = Currency::fromString($currency)->value();
    }

    public function getExposedAddressIds(): UUIDsCollection
    {
        return $this->exposedAddressIds;
    }

    public function addExposedAddressIds(UUIDsCollection $addressIdsCollection): void
    {
        $this->exposedAddressIds = $addressIdsCollection;
    }

    public function hasGas(): bool
    {
        return (bool)$this->hasGas;
    }

    public function setHasGas($hasGas): void
    {
        $this->hasGas = (bool)$hasGas;
    }

    public function hasWater(): bool
    {
        return (bool)$this->hasWater;
    }

    public function setHasWater($hasWater): void
    {
        $this->hasWater = (bool)$hasWater;
    }

    public function hasHood(): bool
    {
        return (bool)$this->hasHood;
    }

    public function setHasHood($hasHood): void
    {
        $this->hasHood = (bool)$hasHood;
    }
}
