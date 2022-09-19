<?php
declare(strict_types=1);

namespace App\Module\Apartment\Infrastructure\Factory\Address;

use App\Module\Apartment\Domain\Model\Address\AddressIdsCollection;
use App\Module\Apartment\Domain\Model\Address\Factory\AddressIdsCollectionFactoryInterface;
use App\Module\Apartment\Domain\Model\Address\ValueObject\AddressId;

final class AddressIdsCollectionFactory implements AddressIdsCollectionFactoryInterface
{
    /** @param AddressId[] $addressIds */
    public static function fromList(array $addressIds): AddressIdsCollection
    {
        return new AddressIdsCollection($addressIds);
    }

    public static function fromQuery(array $addressIds): AddressIdsCollection
    {
        $ids = [];

        foreach ($addressIds as $id) {
            $ids[] = new AddressId($id['id']);
        }

        return new AddressIdsCollection($ids);
    }
}