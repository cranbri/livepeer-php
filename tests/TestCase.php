<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Saloon\Http\Faking\MockClient;

class TestCase extends BaseTestCase
{
    protected MockClient $mockClient;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mockClient = new MockClient();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        MockClient::destroyGlobal();
    }
}
