<?php

use Cranbri\Livepeer\Data\Webhook\CreateWebhookData;
use Cranbri\Livepeer\Enums\WebhookEvent;
use Cranbri\Livepeer\LivepeerConnector;
use Cranbri\Livepeer\Requests\Webhook\CreateWebhookRequest;
use Saloon\Enums\Method;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

test('create webhook request architecture', function () {
    expect(CreateWebhookRequest::class)
        ->toBeSaloonRequest()
        ->toSendPostRequest()
        ->toHaveJsonBody();
});

test('create webhook request has correct endpoint', function () {
    $data = new CreateWebhookData(
        name: 'Test Webhook',
        url: 'https://example.com/webhook',
        events: [WebhookEvent::STREAM_STARTED]
    );
    $request = new CreateWebhookRequest($data);
    expect($request->resolveEndpoint())->toBe('/webhook');
});

test('create webhook request can be created with data', function () {
    $webhookName = 'Test Webhook';
    $webhookUrl = 'https://example.com/webhook';
    $events = [WebhookEvent::STREAM_STARTED, WebhookEvent::STREAM_IDLE];

    $data = new CreateWebhookData(
        name: $webhookName,
        url: $webhookUrl,
        events: $events
    );

    $request = new CreateWebhookRequest($data);

    expect($request)
        ->toBeInstanceOf(CreateWebhookRequest::class)
        ->and($request->resolveEndpoint())->toBe('/webhook')
        ->and($request->getMethod())->toBe(Method::POST)
        ->and($request->body()->all())->toBe([
            'name' => $webhookName,
            'url' => $webhookUrl,
            'events' => array_map(fn(WebhookEvent $event) => $event->value, $events)
        ]);
});

test('create webhook request sends correct body', function () {
    $webhookName = 'Test Webhook';
    $webhookUrl = 'https://example.com/webhook';
    $events = [WebhookEvent::ASSET_READY, WebhookEvent::STREAM_STARTED];

    $data = new CreateWebhookData(
        name: $webhookName,
        url: $webhookUrl,
        events: $events
    );

    $request = new CreateWebhookRequest($data);
    expect($request->body()->all())->toBe($data->toArray());
});

test('create webhook request returns mocked response', function () {
    $mockClient = new MockClient([
        CreateWebhookRequest::class => MockResponse::make([
            'id' => 'test-webhook-id',
            'name' => 'Test Webhook',
            'url' => 'https://example.com/webhook',
            'events' => ['asset.ready', 'stream.started'],
            'createdAt' => '2024-01-01T00:00:00Z'
        ], 201)
    ]);

    $webhookName = 'Test Webhook';
    $webhookUrl = 'https://example.com/webhook';
    $events = [WebhookEvent::ASSET_READY, WebhookEvent::STREAM_STARTED];

    $data = new CreateWebhookData(
        name: $webhookName,
        url: $webhookUrl,
        events: $events
    );

    $request = new CreateWebhookRequest($data);
    $connector = new LivepeerConnector(getTestApiKey());
    $connector->withMockClient($mockClient);
    $response = $connector->send($request);

    expect($response->json())
        ->toHaveKey('id')
        ->toHaveKey('name')
        ->toHaveKey('url')
        ->toHaveKey('events')
        ->toHaveKey('createdAt')
        ->and($response->status())->toBe(201);
});
