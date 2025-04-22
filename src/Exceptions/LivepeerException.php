<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Exceptions;

use Exception;
use Saloon\Http\Response;

final class LivepeerException extends Exception
{
    /**
     * Create a new exception instance
     *
     * @param string $message
     * @param int $code
     * @param Response|null $response
     */
    public function __construct(
        string $message,
        int $code = 0,
        protected ?Response $response = null
    ) {
        parent::__construct($message, $code);
    }

    /**
     * Get the response instance
     *
     * @return Response|null
     */
    public function getResponse(): ?Response
    {
        return $this->response;
    }

    /**
     * Get the response body as an array
     *
     * @return array<mixed>|null
     */
    public function getResponseBody(): ?array
    {
        if (!$this->response) {
            return null;
        }

        return $this->response->json();
    }

    /**
     * Create a new exception from a response
     *
     * @param Response $response
     * @return LivepeerException
     */
    public static function fromResponse(Response $response): self
    {
        $body = $response->json();
        $message = $body['message'] ?? $body['error'] ?? 'Unknown Livepeer API error';
        $code = $response->status();

        return new static(message: $message, code: $code, response: $response);
    }
}
