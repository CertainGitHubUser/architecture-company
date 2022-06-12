<?php

namespace App\Module\Common\Domain\ValueObject;

abstract class AbstractValueObject
{
    protected $value;

    public function __construct($value)
    {
        $value = $this->initialConversion($value);

        $this->validate($value);

        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string)$this->value();
    }

    public function equals(AbstractValueObject $anotherValueObject): bool
    {
        return (
            get_class($anotherValueObject) === get_class($this)
            && $anotherValueObject->value() === $this->value()
        );
    }

    abstract protected function initialConversion($value);

    abstract protected function validate($value): void;

    public static function fromString($value)
    {
        return new static($value);
    }
}