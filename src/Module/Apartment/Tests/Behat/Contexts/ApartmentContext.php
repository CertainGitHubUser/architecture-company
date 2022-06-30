<?php
declare(strict_types=1);

namespace App\Module\Apartment\Tests\Behat\Contexts;

use App\Module\Apartment\Tests\Utils\FixturesPersister\DBALApartmentFixturesPersister;
use App\Module\Common\Tests\Behat\Contexts\BaseContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Webmozart\Assert\Assert;

final class ApartmentContext extends BaseContext
{

    private DBALApartmentFixturesPersister $apartmentFixturesPersister;

    private Response $result;

    public function __construct(
        DBALApartmentFixturesPersister $apartmentFixturesPersister,
        KernelInterface                $kernel
    )
    {
        parent::__construct($kernel);
        $this->apartmentFixturesPersister = $apartmentFixturesPersister;
    }

    /**
     * @Given apartment with id :apartmentId
     */
    public function givenApartmentWithId(string $apartmentId): void
    {
        $this->apartmentFixturesPersister->addApartmentWithId($apartmentId);
    }

    /**
     * @When I ask for apartment with id :apartmentId
     */
    public function iAskForApartmentWithId(string $apartmentId): void
    {
        $path = "/api/v1/apartment/{$apartmentId}";

        $this->result = $this->kernel->handle(Request::create($path, Request::METHOD_GET));
    }

    /**
     * @Then I receive apartment with id :apartmentId
     */
    public function iReceiveApartmentWithId(string $apartmentId): void
    {
        $id = \json_decode($this->result->getContent(), true)['id'];
        Assert::eq($id, $apartmentId);
    }

    /**
     * @AfterScenario
     */
    public function cleanupDb()
    {
        $this->apartmentFixturesPersister->cleanUp();
    }
}