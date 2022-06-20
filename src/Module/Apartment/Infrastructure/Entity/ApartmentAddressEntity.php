<?php
declare(strict_types=1);

namespace App\Module\Apartment\Infrastructure\Entity;

use App\Module\Apartment\Domain\Model\Address\AddressId;
use App\Module\Apartment\Domain\Model\Apartment\ApartmentId;
use App\Module\Apartment\Domain\Model\ApartmentAddress\ApartmentAddressDTOInterface;
use App\Module\Apartment\Domain\Model\ApartmentAddress\ApartmentAddressId;
use Doctrine\ORM\Mapping as ORM;
// TODO create apartmentid  addressid unique index
/**
 * @ORM\Entity()
 * @ORM\Table(name="`apartment_address`")
 */
class ApartmentAddressEntity implements ApartmentAddressDTOInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $apartmentId;

    /**
     * @ORM\Column(type="integer")
     */
    private $addressId;

    public function getId(): ApartmentAddressId
    {
        return ApartmentAddressId::fromString($this->id);
    }

    public function setId($apartmentAddressId): void
    {
        $this->id = ApartmentAddressId::fromString($apartmentAddressId)->value();
    }

    public function getApartmentId(): ApartmentId
    {
        return ApartmentId::fromString($this->apartmentId);
    }

    public function setApartmentId($apartmentId): void
    {
        $this->apartmentId = ApartmentId::fromString($apartmentId)->value();
    }

    public function getAddressId(): AddressId
    {
        return AddressId::fromString($this->addressId);
    }

    public function setAddressId($addressId): void
    {
        $this->addressId = AddressId::fromString($addressId)->value();
    }
}