<?php

use Cranbri\Livepeer\LivepeerConnector;

test('livepeer connector architecture', function () {
    expect(LivepeerConnector::class)
        ->toBeSaloonConnector()
        ->toUseAcceptsJsonTrait()
        ->toUseAlwaysThrowOnErrorsTrait()
        ->toUseTokenAuthentication();
});

test('livepeer connector has correct base url', function () {
    $connector = new LivepeerConnector(getTestApiKey());
    expect($connector->resolveBaseUrl())->toBe('https://livepeer.studio/api');
});

test('livepeer connector sets api key in authorization header', function () {
    $connector = new LivepeerConnector(getTestApiKey());
    /** @var \Saloon\Http\Auth\TokenAuthenticator $authenticator */
    $authenticator = $connector->getAuthenticator();

    expect($authenticator)
        ->toHaveProperty('token')
        ->and($authenticator->token)->toBe('test-api-key');
});
