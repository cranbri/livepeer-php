<?php

use Cranbri\Livepeer\Requests\Webhook\ListWebhooksRequest;
use Saloon\Enums\Method;

test('list webhooks request architecture', function () {
    expect(ListWebhooksRequest::class)
        ->toBeSaloonRequest()
        ->toSendGetRequest();
});

test('list webhooks request has correct endpoint', function () {
    $request = new ListWebhooksRequest();
    expect($request->resolveEndpoint())->toBe('/webhook');
});

test('list webhooks request can be created', function () {
    $request = new ListWebhooksRequest();

    expect($request)
        ->toBeInstanceOf(ListWebhooksRequest::class)
        ->and($request->resolveEndpoint())->toBe('/webhook')
        ->and($request->getMethod())->toBe(Method::GET);
});
