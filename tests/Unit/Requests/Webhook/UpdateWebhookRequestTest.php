<?php

use Cranbri\Livepeer\Data\Webhook\UpdateWebhookData;
use Cranbri\Livepeer\Enums\WebhookEvent;
use Cranbri\Livepeer\Requests\Webhook\UpdateWebhookRequest;
use Saloon\Enums\Method;

test('update webhook request architecture', function () {
    expect(UpdateWebhookRequest::class)
        ->toBeSaloonRequest()
        ->toSendPutRequest()
        ->toHaveJsonBody();
});

test('update webhook request has correct endpoint', function () {
    $webhookId = 'test-webhook-id';
    $data = new UpdateWebhookData(
        name: 'Updated Webhook',
        url: 'https://example.com/updated-webhook',
        events: [WebhookEvent::STREAM_STARTED]
    );
    $request = new UpdateWebhookRequest($webhookId, $data);
    expect($request->resolveEndpoint())->toBe('/webhook/test-webhook-id');
});

test('update webhook request can be created with data', function () {
    $webhookId = 'test-webhook-id';
    $webhookName = 'Updated Webhook';
    $webhookUrl = 'https://example.com/updated-webhook';
    $events = [WebhookEvent::STREAM_STARTED, WebhookEvent::STREAM_IDLE];

    $data = new UpdateWebhookData(
        name: $webhookName,
        url: $webhookUrl,
        events: $events
    );

    $request = new UpdateWebhookRequest($webhookId, $data);

    expect($request)
        ->toBeInstanceOf(UpdateWebhookRequest::class)
        ->and($request->resolveEndpoint())->toBe('/webhook/test-webhook-id')
        ->and($request->getMethod())->toBe(Method::PUT)
        ->and($request->body()->all())->toBe([
            'name' => $webhookName,
            'url' => $webhookUrl,
            'events' => array_map(fn (WebhookEvent $event) => $event->value, $events),
        ]);
});
