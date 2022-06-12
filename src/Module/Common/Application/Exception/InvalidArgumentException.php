<?php

namespace App\Module\Common\Application\Exception;

use App\Module\Common\Domain\Exception\InvalidValueException;

final class InvalidArgumentException extends \Exception implements InvalidValueException
{

}