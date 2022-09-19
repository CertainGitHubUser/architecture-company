<?php
declare(strict_types=1);

namespace App\Module\Apartment\Infrastructure\Entity;

use App\Module\Apartment\Domain\Model\Address\AddressDTOInterface;
use App\Module\Apartment\Domain\Model\Address\ValueObject\AddressId;
use App\Module\Apartment\Domain\Model\Address\ValueObject\Latitude;
use App\Module\Apartment\Domain\Model\Address\ValueObject\Longitude;
use App\Module\Apartment\Domain\Model\Address\ValueObject\ZIPCode;
use App\Module\Common\Domain\ValueObject\NotEmptyString;
use App\Module\Common\Domain\ValueObject\UUID;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="`address`")
 */
class AddressEntity implements AddressDTOInterface
{
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
     * @ORM\Column(type="string", length=128)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $apartmentNumber;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $buildingNumber;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $ZIPCode;

    public function getId(): AddressId
    {
        return AddressId::fromString($this->id);
    }

    public function setId($id): void
    {
        $this->id = AddressId::fromString($id)->value();
    }

    public function getExposedId(): UUID
    {
        return UUID::fromString($this->exposedId);
    }

    public function setExposedId($exposedId): void
    {
        $this->exposedId = UUID::fromString($exposedId)->value();
    }

    public function getCity(): NotEmptyString
    {
        return NotEmptyString::fromString($this->city);
    }

    public function setCity($city): void
    {
        $this->city = NotEmptyString::fromString($city)->value();
    }

    public function getCountry(): NotEmptyString
    {
        return NotEmptyString::fromString($this->country);
    }

    public function setCountry($country): void
    {
        $this->country = NotEmptyString::fromString($country)->value();
    }

    public function getStreet(): NotEmptyString
    {
        return NotEmptyString::fromString($this->street);
    }

    public function setStreet($street): void
    {
        $this->street = NotEmptyString::fromString($street)->value();
    }

    public function getBuildingNumber(): NotEmptyString
    {
        return NotEmptyString::fromString($this->buildingNumber);
    }

    public function setBuildingNumber($buildingNumber): void
    {
        $this->buildingNumber = NotEmptyString::fromString($buildingNumber)->value();
    }

    public function getApartmentNumber(): NotEmptyString
    {
        return NotEmptyString::fromString($this->apartmentNumber);
    }

    public function setApartmentNumber($apartmentNumber): void
    {
        $this->apartmentNumber = NotEmptyString::fromString($apartmentNumber)->value();
    }

    public function getLatitude(): Latitude
    {
        return Latitude::fromString($this->latitude);
    }

    public function setLatitude($latitude): void
    {
        $this->latitude = Latitude::fromString($this->latitude)->value();
    }

    public function getLongitude(): Longitude
    {
        return Longitude::fromString($this->longitude);
    }

    public function setLongitude($longitude): void
    {
        $this->longitude = Longitude::fromString($longitude)->value();
    }

    public function getZIPCode(): ZIPCode
    {
        return ZIPCode::fromString($this->ZIPCode);
    }

    public function setZIPCode($ZIPCode): void
    {
        $this->ZIPCode = ZIPCode::fromString($ZIPCode)->value();
    }
}