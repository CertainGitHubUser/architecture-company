<?php

namespace App\Module\Common\Application\DTO;

trait InitializeFromArrayTrait
{
    public static function fromArray(array $rawData): self
    {
        $ret = new self();

        foreach ($rawData as $key => $value) {
            if (property_exists($ret, $key)) {
                $ret->{$key} = $value;
            }
        }

        return $ret;
    }
}