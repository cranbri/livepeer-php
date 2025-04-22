<?php

use Cranbri\Livepeer\Requests\Webhook\GetWebhookRequest;
use Saloon\Enums\Method;

test('get webhook request architecture', function () {
    expect(GetWebhookRequest::class)
        ->toBeSaloonRequest()
        ->toSendGetRequest();
});

test('get webhook request has correct endpoint', function () {
    $webhookId = 'test-webhook-id';
    $request = new GetWebhookRequest($webhookId);
    expect($request->resolveEndpoint())->toBe('/webhook/test-webhook-id');
});

test('get webhook request can be created', function () {
    $webhookId = 'test-webhook-id';
    $request = new GetWebhookRequest($webhookId);

    expect($request)
        ->toBeInstanceOf(GetWebhookRequest::class)
        ->and($request->resolveEndpoint())->toBe('/webhook/test-webhook-id')
        ->and($request->getMethod())->toBe(Method::GET);
});
