<?php

use Cranbri\Livepeer\Data\Webhook\CreateWebhookData;
use Cranbri\Livepeer\Data\Webhook\UpdateWebhookData;
use Cranbri\Livepeer\Enums\WebhookEvent;
use Cranbri\Livepeer\Livepeer;

beforeEach(function () {
    $this->livepeer = new Livepeer($_ENV['LIVEPEER_API_KEY']);
});

test('can create a webhook', function () {
    $webhookName = testResourceName('Webhook');
    $webhookUrl = 'https://example.com/webhook-' . uniqid();

    $data = new CreateWebhookData(
        name: $webhookName,
        url: $webhookUrl,
        events: [
            WebhookEvent::STREAM_STARTED,
            WebhookEvent::STREAM_IDLE,
        ]
    );

    $response = $this->livepeer->createWebhook($data);

    expect($response)
        ->toHaveKey('id')
        ->toHaveKey('name')
        ->toHaveKey('url')
        ->toHaveKey('events')
        ->and($response['name'])->toBe($webhookName)
        ->and($response['url'])->toBe($webhookUrl)
        ->and($response['events'])->toContain(WebhookEvent::STREAM_STARTED->value)
        ->and($response['events'])->toContain(WebhookEvent::STREAM_IDLE->value);

});

test('can list webhooks', function () {
    $webhooks = $this->livepeer->listWebhooks();

    expect($webhooks)
        ->toBeArray()
        ->when(
            fn () => count($webhooks) > 0,
            fn ($webhooks) => $webhooks->and($webhooks->value[0])->toHaveKey('id')
        );
});

test('can get a webhook', function () {
    $webhooks = $this->livepeer->listWebhooks();

    if (empty($webhooks)) {
        $this->markTestSkipped('No webhooks available for testing');
    }
    $webhookId = $webhooks[0]['id'];

    $webhook = $this->livepeer->getWebhook($webhookId);

    expect($webhook)
        ->toHaveKey('id')
        ->toHaveKey('name')
        ->and($webhook['id'])->toBe($webhookId);
})->depends('can create a webhook');

test('can update a webhook', function () {
    $webhooks = $this->livepeer->listWebhooks();

    if (empty($webhooks)) {
        $this->markTestSkipped('No webhooks available for testing');
    }
    $webhookId = $webhooks[0]['id'];

    $newName = testResourceName('Updated Webhook');
    $newUrl = 'https://example.com/updated-webhook-' . uniqid();

    $data = new UpdateWebhookData(
        name: $newName,
        url: $newUrl,
        events: [
            WebhookEvent::STREAM_STARTED,
            WebhookEvent::STREAM_IDLE,
            WebhookEvent::RECORDING_READY,
        ]
    );

    $response = $this->livepeer->updateWebhook($webhookId, $data);

    expect($response)
        ->toHaveKey('name')
        ->toHaveKey('url')
        ->toHaveKey('events')
        ->and($response['name'])->toBe($newName)
        ->and($response['url'])->toBe($newUrl)
        ->and($response['events'])->toContain(WebhookEvent::RECORDING_READY->value);
})->depends('can create a webhook')
    ->skip('Failing on Livepeer side - confirmation requested.');

test('can delete a webhook', function () {
    $webhooksToDelete = $this->livepeer->listWebhooks();

    if (empty($webhooksToDelete)) {
        $this->markTestSkipped('No webhooks to delete');
    }

    foreach ($webhooksToDelete as $webhook) {
        $response = $this->livepeer->deleteWebhook($webhook['id']);
        expect($response)->not->toHaveKey('error');
    }
});
