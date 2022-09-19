<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Address;

use App\Module\Apartment\Domain\Model\Address\ValueObject\AddressId;
use App\Module\Common\Domain\ValueObject\UnsignedInt;

final class AddressIdsCollection
{
    /** @var AddressId[] */
    private array $addressIds;

    private array $stringArray;

    public function __construct(array $addressIds)
    {
        $this->addressIds = $addressIds;
    }

    public function getAll(): array
    {
        return $this->addressIds;
    }

    public function toStringArray(): array
    {
        if (empty($this->stringArray)) {
            foreach ($this->addressIds as $addressId) {
                $this->stringArray[] = $addressId->value();
            }
        }

        return $this->stringArray;
    }

    public function count(): UnsignedInt
    {
        return new UnsignedInt(count($this->addressIds));
    }

    public function toString(): string
    {
        $stringArray = $this->toStringArray();

        return implode(', ', $stringArray);
    }
}