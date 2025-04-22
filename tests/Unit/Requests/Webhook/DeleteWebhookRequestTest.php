<?php

use Cranbri\Livepeer\Requests\Webhook\DeleteWebhookRequest;
use Saloon\Enums\Method;

test('delete webhook request architecture', function () {
    expect(DeleteWebhookRequest::class)
        ->toBeSaloonRequest()
        ->toSendDeleteRequest();
});

test('delete webhook request has correct endpoint', function () {
    $webhookId = 'test-webhook-id';
    $request = new DeleteWebhookRequest($webhookId);
    expect($request->resolveEndpoint())->toBe('/webhook/test-webhook-id');
});

test('delete webhook request can be created', function () {
    $webhookId = 'test-webhook-id';
    $request = new DeleteWebhookRequest($webhookId);

    expect($request)
        ->toBeInstanceOf(DeleteWebhookRequest::class)
        ->and($request->resolveEndpoint())->toBe('/webhook/test-webhook-id')
        ->and($request->getMethod())->toBe(Method::DELETE);
});
