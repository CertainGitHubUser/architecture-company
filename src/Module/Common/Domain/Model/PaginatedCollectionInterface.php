<?php

namespace App\Module\Common\Domain\Model;

use App\Module\Common\Domain\ValueObject\AbstractValueObject;
use JsonSerializable;

interface PaginatedCollectionInterface
{
    /** @return JsonSerializable [] */
    public function all(): array;

    public function getLimit(): AbstractValueObject;

    public function getOffset(): AbstractValueObject;

    public function getTotal(): AbstractValueObject;
}