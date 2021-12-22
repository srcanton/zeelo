<?php

declare(strict_types=1);

namespace Zeelo\Tests\Functional\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Exception;
use Zeelo\Shared\Infrastructure\Symfony\Kernel;

class MainContext implements Context
{

    private static Kernel $kernel;
    private static array $headers;
    private static Response $response;

    public function __construct(KernelInterface $kernel)
    {
        self::$kernel = $kernel;
        self::$headers = [];
    }

    /**
     * @Given /^I call "([^"]*)" "([^"]*)"$/
     *
     * @throws Exception
     */
    public function iCall(string $verb, string $path): void
    {
        $this->iCallWithBody($verb, $path);
    }

    /**
     * @Then /^I call "([^"]*)" "([^"]*)" with body:$/
     * @throws Exception
     */
    public function iCallWithBody(string $verb, string $path, PyStringNode $string = null): void
    {
        $request = Request::create($path, $verb, [], [], [], [], $string?->getRaw());

        $request->headers->add(self::$headers);

        self::$response = self::$kernel->handle($request);
    }

    /**
     * @Then /^the status code should be (\d+)$/
     */
    public function theStatusCodeShouldBe(int $statusCode): void
    {
        Assert::assertEquals($statusCode, self::$response->getStatusCode());
    }

    /**
     * @Given /^the response should be exactly this JSON$/
     */
    public function theResponseShouldBeThisJSON(PyStringNode $jsonString): void
    {
        Assert::assertJsonStringEqualsJsonString($jsonString->getRaw(), self::$response->getContent());
    }

    /**
     * @Then /^the response should contain strings:$/
     */
    public function theResponseShouldContainStrings(PyStringNode $expected)
    {
        Assert::assertStringContainsString($expected->getRaw(), self::$response->getContent());
    }

    /**
     * @Given /^the request body is:$/
     */
    public function theRequestBodyIs(PyStringNode $expected)
    {
        Assert::assertJsonStringEqualsJsonString($expected->getRaw(), self::$headers->getContent());
    }

}
