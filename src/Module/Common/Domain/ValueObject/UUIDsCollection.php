<?php
declare(strict_types=1);

namespace App\Module\Common\Domain\ValueObject;

final class UUIDsCollection implements \JsonSerializable
{
    /** @var UUID[] */
    private array $UUIDs;

    private array $stringArray;

    public function __construct(array $UUIDs)
    {
        $this->UUIDs = $UUIDs;
    }

    public function getAll(): array
    {
        return $this->UUIDs;
    }

    public function toStringArray(): array
    {
        if (empty($this->stringArray)) {
            foreach ($this->UUIDs as $UUID) {
                $this->stringArray[] = $UUID->value();
            }
        }

        return $this->stringArray;
    }

    public function toString(): string
    {
        $stringArray = $this->toStringArray();

        return implode(', ', $stringArray);
    }

    public function count(): UnsignedInt
    {
        return new UnsignedInt(count($this->UUIDs));
    }

    public function jsonSerialize()
    {
        return [$this->UUIDs];
    }
}