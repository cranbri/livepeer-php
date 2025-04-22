<?php

use Cranbri\Livepeer\Requests\Task\GetTaskRequest;
use Saloon\Enums\Method;

test('get task request architecture', function () {
    expect(GetTaskRequest::class)
        ->toBeSaloonRequest()
        ->toSendGetRequest();
});

test('get task request has correct endpoint', function () {
    $request = new GetTaskRequest('test-task-id');
    expect($request->resolveEndpoint())->toBe('/task/test-task-id');
});

test('get task request can be created', function () {
    $request = new GetTaskRequest('test-task-id');

    expect($request)
        ->toBeInstanceOf(GetTaskRequest::class)
        ->and($request->resolveEndpoint())->toBe('/task/test-task-id')
        ->and($request->getMethod())->toBe(Method::GET);
});
