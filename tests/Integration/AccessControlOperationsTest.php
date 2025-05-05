<?php

use Cranbri\Livepeer\Data\AccessControl\UpdateSigningKeyData;
use Cranbri\Livepeer\Livepeer;

beforeEach(function () {
    $this->livepeer = new Livepeer($_ENV['LIVEPEER_API_KEY']);
});

// Signing key creation test
test('can create a signing key', function () {
    $response = $this->livepeer->createSigningKey();

    expect($response)
        ->toHaveKey('id')
        ->toHaveKey('publicKey')
        ->toHaveKey('privateKey');
});

test('can list signing keys', function () {
    $keys = $this->livepeer->listSigningKeys();

    expect($keys)
        ->toBeArray()
        ->when(
            fn () => count($keys) > 0,
            fn ($keys) => $keys->and($keys->value[0])->toHaveKey('id')
        );
});


test('can get a signing key', function () {
    $keys = $this->livepeer->listSigningKeys();

    if (empty($keys)) {
        $this->markTestSkipped('No key ID available for testing');
    }

    $keyId = $keys[0]['id'];

    $key = $this->livepeer->getSigningKey($keyId);

    expect($key)
        ->toHaveKey('id')
        ->toHaveKey('publicKey')
        ->and($key['id'])->toBe($keyId);
})->depends('can create a signing key');

test('can update a signing key', function () {
    $keys = $this->livepeer->listSigningKeys();

    if (empty($keys)) {
        $this->markTestSkipped('No key ID available for testing');
    }

    $keyId = $keys[0]['id'];

    $data = new UpdateSigningKeyData(
        disabled: false,
        name: 'Updated Signing Key ' . uniqid()
    );

    $this->livepeer->updateSigningKey($keyId, $data);
    $signingKey = $this->livepeer->getSigningKey($keyId);

    expect($signingKey)
        ->toHaveKey('id')
        ->toHaveKey('name')
        ->and($signingKey['id'])->toBe($keyId)
        ->and($signingKey['name'])->toBe($data->name);
})->depends('can create a signing key');

test('can delete a signing key', function () {
    $keysToDelete = $this->livepeer->listSigningKeys();

    if (empty($keysToDelete)) {
        $this->markTestSkipped('No signing keys to delete');
    }

    foreach ($keysToDelete as $key) {
        $response = $this->livepeer->deleteSigningKey($key['id']);
        expect($response)->not->toHaveKey('error');
    }
});
