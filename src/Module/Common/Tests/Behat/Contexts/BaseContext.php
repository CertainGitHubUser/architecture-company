<?php
declare(strict_types=1);

namespace App\Module\Common\Tests\Behat\Contexts;

use Behat\Behat\Context\Context;
use Symfony\Component\HttpKernel\KernelInterface;

class BaseContext implements Context
{
    protected KernelInterface $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
        $GLOBALS['app'] = $kernel;
    }
}