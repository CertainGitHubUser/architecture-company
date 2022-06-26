<?php
declare(strict_types=1);

namespace App\Module\Apartment\Tests\Behat\Contexts;

use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;

final class ApartmentContext implements Context
{
    /**
     * @Then apartment context is loaded
     */
    public function apartmentContextIsLoaded(): void
    {
        Assert::isTrue(true);
    }
}