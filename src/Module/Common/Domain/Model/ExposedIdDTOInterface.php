<?php

namespace App\Module\Common\Domain\Model;

use App\Module\Common\Domain\ValueObject\UnsignedInt;
use Ramsey\Uuid\Uuid;
//TODO implement test that will check all 3 layers
interface ExposedIdDTOInterface
{
    public function getPrimaryKey(): UnsignedInt;

    public function setPrimaryKey(UnsignedInt $primaryKey): void;

    public function getId(): Uuid;

    public function setId(Uuid $id);
}