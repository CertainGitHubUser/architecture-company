<?php

namespace App\Module\Common\Domain\Model;

use App\Module\Common\Domain\ValueObject\UnsignedInt;
use Ramsey\Uuid\Uuid;

trait ExposedIdModelTrait
{
    private ExposedIdDTOInterface $dto;

    public function primaryKey(): UnsignedInt
    {
        return $this->dto->getPrimaryKey();
    }


    public function id(): Uuid
    {
        return $this->dto->getId();
    }

}