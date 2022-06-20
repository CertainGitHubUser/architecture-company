<?php
declare(strict_types=1);

namespace App\Module\Apartment\Infrastructure\Factory\Address;

use App\Module\Apartment\Domain\Model\Address\AddressId;
use App\Module\Apartment\Domain\Model\Address\AddressIdsCollection;
use App\Module\Apartment\Domain\Model\Address\Factory\AddressIdsCollectionFactoryInterface;

final class AddressIdsCollectionFactory implements AddressIdsCollectionFactoryInterface
{
    public function fromQuery(array $addressIds): AddressIdsCollection
    {
        $ids = [];

        foreach ($addressIds as $id) {
            $ids[] = new AddressId($id['id']);
        }

        return new AddressIdsCollection($ids);
    }
}