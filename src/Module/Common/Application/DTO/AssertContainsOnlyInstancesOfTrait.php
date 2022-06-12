<?php

namespace App\Module\Common\Application\DTO;

use App\Module\Common\Application\Exception\InvalidArgumentException;

trait AssertContainsOnlyInstancesOfTrait
{
    protected function assertContainsOnlyInstancesOf(string $className, array $data): void
    {
        foreach ($data as $datum) {
            if (!($datum instanceof $className)) {
                throw new InvalidArgumentException(
                    "invalid item in collection of {$className}: " . print_r($datum, true)
                );
            }
        }
    }
}