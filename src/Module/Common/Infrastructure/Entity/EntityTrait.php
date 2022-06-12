<?php

namespace App\Module\Common\Infrastructure\Entity;

trait EntityTrait
{
    protected function _initialize(object $dto): void
    {
        foreach ($dto as $name => $value) {
            $this->_setProperty($name, $value);
        }
    }

    protected function _update(object $dto): void
    {
        foreach ($dto as $name => $value) {
            if ($value !== null) {
                $this->_setProperty($name, $value);
            }
        }
    }

    protected function _setProperty(string $name, $value): void
    {
        $setterName = 'set' . ucfirst($name);

        if (method_exists($this, $setterName)) {
            $this->{$setterName}($value);
        }
    }
}