<?php
declare(strict_types=1);

namespace App\Module\Apartment\Infrastructure;

use App\Module\Apartment\Infrastructure\DependencyInjection\ACApartmentExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class ACApartmentBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new ACApartmentExtension();
    }
}