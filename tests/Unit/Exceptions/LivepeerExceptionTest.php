<?php

use Cranbri\Livepeer\Exceptions\LivepeerException;
use Saloon\Http\Response;
use Saloon\Http\Faking\MockResponse;

test('livepeer exception can be created from response', function () {
    $mockResponse = MockResponse::make([
        'errors' => [
            [
                'code' => 'NOT_FOUND',
                'message' => 'Resource not found'
            ]
        ]
    ], 404);

    $exception = LivepeerException::fromResponse($mockResponse);

    expect($exception)
        ->toBeInstanceOf(LivepeerException::class)
        ->and($exception->getMessage())->toBe('Resource not found')
        ->and($exception->getCode())->toBe(404)
        ->and($exception->getResponse())->toBe($mockResponse);
});

test('livepeer exception can be created from response with multiple errors', function () {
    $mockResponse = MockResponse::make([
        'errors' => [
            [
                'code' => 'VALIDATION_ERROR',
                'message' => 'Invalid input'
            ],
            [
                'code' => 'MISSING_FIELD',
                'message' => 'Required field missing'
            ]
        ]
    ], 400);

    $exception = LivepeerException::fromResponse($mockResponse);

    expect($exception)
        ->toBeInstanceOf(LivepeerException::class)
        ->and($exception->getMessage())->toBe('Invalid input, Required field missing')
        ->and($exception->getCode())->toBe(400)
        ->and($exception->getResponse())->toBe($mockResponse);
});

test('livepeer exception can be created from response without errors array', function () {
    $mockResponse = MockResponse::make([
        'message' => 'Internal server error'
    ], 500);

    $exception = LivepeerException::fromResponse($mockResponse);

    expect($exception)
        ->toBeInstanceOf(LivepeerException::class)
        ->and($exception->getMessage())->toBe('Internal server error')
        ->and($exception->getCode())->toBe(500)
        ->and($exception->getResponse())->toBe($mockResponse);
});
