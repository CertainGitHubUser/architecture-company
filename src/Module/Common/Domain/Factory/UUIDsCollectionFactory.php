<?php
declare(strict_types=1);

namespace App\Module\Common\Domain\Factory;

use App\Module\Common\Domain\ValueObject\UUID;
use App\Module\Common\Domain\ValueObject\UUIDsCollection;

final class UUIDsCollectionFactory
{
    public static function fromStringArray(array $values): UUIDsCollection
    {
        $UUIDs = [];

        foreach ($values as $value) {
            $UUIDs[] = new UUID($value);
        }

        return new UUIDsCollection($UUIDs);
    }

    public static function fromQuery(array $items): UUIDsCollection
    {
        $UUIDs = [];

        foreach ($items as $item) {
            $UUIDs[] = new UUID($item['exposedId']);
        }

        return new UUIDsCollection($UUIDs);
    }
}