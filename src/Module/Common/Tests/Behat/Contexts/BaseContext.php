<?php
declare(strict_types=1);

namespace App\Module\Common\Tests\Behat\Contexts;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Webmozart\Assert\Assert;

class BaseContext implements Context
{
    protected KernelInterface $kernel;

    protected Response $result;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
        $GLOBALS['app'] = $kernel;
    }

    /**
     * @Transform  /^\[(.*)\]$/
     */
    public function convertStringToArray($string)
    {
        return explode(',', $string);
    }

    /**
     * @Then I receive not found exception
     */
    public function thenIReceiveNotFoundException(): void
    {
        Assert::eq(404, $this->result->getStatusCode());
    }

    /**
     * @Then response with status code should be :statusCode
     */
    public function thenResponseWithStatusCodeShouldBe(int $statusCode): void
    {
        Assert::eq($statusCode, $this->result->getStatusCode());
    }

    protected function jsonPyStringToArray(PyStringNode $string): array
    {
        return json_decode($string->getRaw(), true);
    }
}