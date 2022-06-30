<?php
declare(strict_types=1);

namespace App\Module\Apartment\Infrastructure;

use App\Module\Apartment\Infrastructure\DependencyInjection\ACApartmentExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

final class ACApartmentBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new ACApartmentExtension();
    }
}