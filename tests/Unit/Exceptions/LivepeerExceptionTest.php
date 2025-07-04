<?php

use Cranbri\Livepeer\Exceptions\LivepeerException;
use Saloon\Enums\Method;
use Saloon\Http\Connector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\Request;

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
            'message' => 'Resource not found',
        ], 404),
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
            'message' => 'Internal server error',
        ], 500),
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

test('livepeer exception can be created from response with error field', function () {
    $connector = new TestConnector();
    $mockClient = new MockClient([
        TestRequest::class => MockResponse::make([
            'error' => 'Invalid API key',
        ], 401),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send(new TestRequest());
    $exception = LivepeerException::fromResponse($response);

    expect($exception)
        ->toBeInstanceOf(LivepeerException::class)
        ->and($exception->getMessage())->toBe('Invalid API key')
        ->and($exception->getCode())->toBe(401)
        ->and($exception->getResponse())->toBe($response);
});

test('livepeer exception can be created from response with no message or error field', function () {
    $connector = new TestConnector();
    $mockClient = new MockClient([
        TestRequest::class => MockResponse::make([
            'data' => null,
        ], 400),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send(new TestRequest());
    $exception = LivepeerException::fromResponse($response);

    expect($exception)
        ->toBeInstanceOf(LivepeerException::class)
        ->and($exception->getMessage())->toBe('Unknown Livepeer API error')
        ->and($exception->getCode())->toBe(400)
        ->and($exception->getResponse())->toBe($response);
});

test('livepeer exception can be created manually', function () {
    $exception = new LivepeerException('Custom error message', 422);

    expect($exception)
        ->toBeInstanceOf(LivepeerException::class)
        ->and($exception->getMessage())->toBe('Custom error message')
        ->and($exception->getCode())->toBe(422)
        ->and($exception->getResponse())->toBeNull();
});

test('livepeer exception can get response body', function () {
    $responseData = ['message' => 'Validation failed', 'errors' => ['field' => 'required']];
    $connector = new TestConnector();
    $mockClient = new MockClient([
        TestRequest::class => MockResponse::make($responseData, 422),
    ]);
    $connector->withMockClient($mockClient);

    $response = $connector->send(new TestRequest());
    $exception = LivepeerException::fromResponse($response);

    expect($exception->getResponseBody())->toBe($responseData);
});

test('livepeer exception returns null response body when no response', function () {
    $exception = new LivepeerException('Custom error message');
    expect($exception->getResponseBody())->toBeNull();
});
