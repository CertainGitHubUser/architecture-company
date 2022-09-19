<?php
declare(strict_types=1);

namespace App\Module\Apartment\Tests\Behat\Contexts;

use App\Module\Apartment\Tests\Utils\FixturesPersister\DBALApartmentFixturesPersister;
use App\Module\Apartment\Tests\Utils\RequestDataGenerator\ApartmentDataGenerator;
use App\Module\Apartment\Tests\Utils\RequestDataGenerator\CreateApartmentRequestDataGenerator;
use App\Module\Apartment\Tests\Utils\RequestDataGenerator\EditApartmentRequestDataGenerator;
use App\Module\Common\Domain\Utils\AssertArraysEquals;
use App\Module\Common\Tests\Behat\Contexts\BaseContext;
use Behat\Gherkin\Node\PyStringNode;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;
use Webmozart\Assert\Assert;

final class ApartmentContext extends BaseContext
{
    private DBALApartmentFixturesPersister $apartmentFixturesPersister;

    private array $apartment;

    public function __construct(
        DBALApartmentFixturesPersister $apartmentFixturesPersister,
        KernelInterface                $kernel
    )
    {
        parent::__construct($kernel);
        $this->apartmentFixturesPersister = $apartmentFixturesPersister;
        $this->apartmentFixturesPersister->cleanUp();
    }

    /**
     * @Given Addresses with ids:
     */
    public function givenAddressesWithIds(PyStringNode $ids): void
    {
        $this->apartmentFixturesPersister->addAddressesWithIds($ids->getStrings());
    }

    /**
     * @Given apartment will have id :id
     */
    public function givenApartmentWillHaveId(string $id): void
    {
        $this->apartment = ApartmentDataGenerator::generate(['exposed_id' => $id]);
    }

    /**
     * @Given apartment will have total square :square
     */
    public function givenApartmentWillHaveTotalSquare(int $square): void
    {
        $this->apartment['square'] = $square;
    }

    /**
     * @Given apartment will have rooms:
     */
    public function givenApartmentWillHaveRooms(PyStringNode $rooms): void
    {
        $this->apartment['rooms'] = $this->jsonPyStringToArray($rooms)['rooms'];
    }

    /**
     * @Given apartment will have address ids:
     */
    public function givenApartmentWiiHaveAddressIds(PyStringNode $addressIds): void
    {
        $this->apartment['addresses'] = $addressIds->getStrings();
    }

    /**
     * @Given apartment will have the following config:
     */
    public function apartmentWillHaveTheFollowingConfig(PyStringNode $config): void
    {
        $this->apartment = $this->jsonPyStringToArray($config);
    }

    /**
     * @Given apartment with id :apartmentId
     */
    public function givenApartmentWithId(string $apartmentId): void
    {
        $this->apartmentFixturesPersister->addApartmentWithId($apartmentId);
    }

    /**
     * @Given apartment with id :apartmentId and addresses with ids:
     */
    public function givenApartmentWithIdAndAddressIds(string $apartmentId, PyStringNode $addressIds): void
    {
        $this->apartmentFixturesPersister->addApartmentWithIdAndAddressIds($apartmentId, $addressIds->getStrings());
    }

    /**
     * @Given apartment with id :apartmentId and following config:
     */
    public function givenApartmentWithIdAndFollowingConfig(string $apartmentId, PyStringNode $config): void
    {
        $this->apartmentFixturesPersister->addApartmentWithIdAndConfig($apartmentId, $this->jsonPyStringToArray($config));
    }

    /**
     * @Given apartment with following config:
     */
    public function givenApartmentWithFollowingConfig(PyStringNode $config): void
    {
        $this->apartmentFixturesPersister->addApartmentWithConfig($this->jsonPyStringToArray($config));
    }

    /**
     * @When I try to create this apartment
     */
    public function whenITryToCreateThisApartment(): void
    {
        $path = "/api/v1/apartment";

        $this->result = $this->kernel->handle(Request::create(
            $path,
            Request::METHOD_POST,
            [],
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            CreateApartmentRequestDataGenerator::fromApartmentData($this->apartment)
        ));
    }

    /**
     * @When I try to edit this apartment
     */
    public function whenITryToEditThisApartment(): void
    {
        $path = "/api/v1/apartment/{$this->apartment['apartment']['exposed_id']}";

        $this->result = $this->kernel->handle(Request::create(
            $path,
            Request::METHOD_PUT,
            [],
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            EditApartmentRequestDataGenerator::fromApartmentData($this->apartment)
        ));
    }

    /**
     * @When I try to remove this apartment with id :id
     */
    public function whenITryToRemoveThisApartment(string $id): void
    {
        $path = "/api/v1/apartment/{$id}";

        $this->result = $this->kernel->handle(Request::create(
            $path,
            Request::METHOD_DELETE,
            [],
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        ));
    }

    /**
     * @When I ask for apartment with id :apartmentId
     */
    public function whenIAskForApartmentWithId(string $apartmentId): void
    {
        $path = "/api/v1/apartment/{$apartmentId}";

        $this->result = $this->kernel->handle(Request::create($path, Request::METHOD_GET));
    }

    /**
     * @Then I receive apartment with id :apartmentId
     */
    public function thenIReceiveApartmentWithId(string $apartmentId): void
    {
        $id = \json_decode($this->result->getContent(), true)['id'];
        Assert::eq($id, $apartmentId);
    }

    /**
     * @Then I ensure that all apartment values were changed:
     */
    public function thenIEnsureThatAllApartmentValuesWereChanged(PyStringNode $expectedResponse): void
    {
        $expectedResult = $this->jsonPyStringToArray($expectedResponse);
        $result = json_decode($this->result->getContent(), true);

        Assert::true(AssertArraysEquals::eq($expectedResult, $result));
    }

    /**
     * @Then I ensure that all apartment data with id :id was removed
     */
    public function thenIEnsureThatAllApartmentDataWasRemoved(int $id): void
    {
        Assert::true($this->apartmentFixturesPersister->assertAllApartmentDataWasRemoved($id));
    }

    /**
     * @AfterScenario
     */
    public function cleanupDb(): void
    {
        $this->apartmentFixturesPersister->cleanUp();
    }
}