<?php
declare(strict_types=1);

namespace App\Module\Apartment\Domain\Model\Address;

final class AddressesCollection
{
    /** @var Address[] */
    public array $addresses;

    public function __construct(array $addresses)
    {
        $this->addresses = $addresses;
    }

    public function toArray(): array
    {
        return $this->addresses;
    }
}