<?php

declare(strict_types=1);

namespace Cranbri\Livepeer;

use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

class LivepeerConnector extends Connector
{
    use AcceptsJson;
    use AlwaysThrowOnErrors;

    /**
     * Create a new Livepeer Connector instance
     *
     * @param string $apiKey The Livepeer API key
     */
    public function __construct(protected string $apiKey)
    {
    }

    /**
     * Define the base URL of the Livepeer API
     *
     * @return string
     */
    public function resolveBaseUrl(): string
    {
        return 'https://livepeer.studio/api';
    }

    /**
     * Define default headers for the Livepeer API
     *
     * @return string[]
     */
    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * Define the authentication for the Livepeer API
     *
     * @return TokenAuthenticator
     */
    protected function defaultAuth(): TokenAuthenticator
    {
        return new TokenAuthenticator($this->apiKey);
    }
}
