<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Address;

class AddressIdsCollection
{
    /** @var AddressId[] */
    private array $addressIds;

    public function __construct(array $addressIds)
    {
        $this->addressIds = $addressIds;
    }

    public function getAll(): array
    {
        return $this->addressIds;
    }
}