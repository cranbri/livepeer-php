<?php

use Cranbri\Livepeer\Exceptions\LivepeerException;
use Saloon\Http\Response;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Request;
use Saloon\Http\Connector;
use Saloon\Enums\Method;

class TestConnector extends Connector
{
    public function resolveBaseUrl(): string
    {
        return 'https://example.com';
    }
}

class TestRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/test';
    }
}

test('livepeer exception can be created from response', function () {
    $connector = new TestConnector();
    $mockClient = new MockClient([
        TestRequest::class => MockResponse::make([
            'message' => 'Resource not found'
        ], 404)
    ]);

    $connector->withMockClient($mockClient);

    $response = $connector->send(new TestRequest());
    $exception = LivepeerException::fromResponse($response);

    expect($exception)
        ->toBeInstanceOf(LivepeerException::class)
        ->and($exception->getMessage())->toBe('Resource not found')
        ->and($exception->getCode())->toBe(404)
        ->and($exception->getResponse())->toBe($response);
});

test('livepeer exception can be created from response without errors array', function () {
    $connector = new TestConnector();
    $mockClient = new MockClient([
        TestRequest::class => MockResponse::make([
            'message' => 'Internal server error'
        ], 500)
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send(new TestRequest());
    $exception = LivepeerException::fromResponse($response);

    expect($exception)
        ->toBeInstanceOf(LivepeerException::class)
        ->and($exception->getMessage())->toBe('Internal server error')
        ->and($exception->getCode())->toBe(500)
        ->and($exception->getResponse())->toBe($response);
});
