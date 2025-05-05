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
     * @return self
     */
    public static function fromResponse(Response $response): self
    {
        $body = $response->json();
        $message = '';

        if (isset($body['message'])) {
            $message = is_string($body['message']) ? $body['message'] : self::formatValue($body['message']);
        } elseif (isset($body['error'])) {
            $message = is_string($body['error']) ? $body['error'] : self::formatValue($body['error']);
        } elseif (isset($body['errors']) && is_array($body['errors']) && count($body['errors']) > 0) {
            if (is_string($body['errors'][0])) {
                $message = $body['errors'][0];
            } elseif (is_array($body['errors'][0]) && isset($body['errors'][0]['message'])) {
                $message = is_string($body['errors'][0]['message'])
                    ? $body['errors'][0]['message']
                    : self::formatValue($body['errors'][0]['message']);
            }
        } elseif (isset($body['errors']) && is_array($body['errors']) && !empty($body['errors'])) {
            $errorMessages = [];
            foreach ($body['errors'] as $field => $error) {
                if (is_string($error)) {
                    $errorMessages[] = "$field: $error";
                } elseif (is_array($error) && !empty($error)) {
                    $firstError = $error[0] ?? null;
                    $errorMessages[] = "$field: " . self::formatValue($firstError);
                }
            }
            if (!empty($errorMessages)) {
                $message = implode('; ', $errorMessages);
            }
        }

        if (empty($message)) {
            $message = 'Unknown Livepeer API error';
        }

        $code = $response->status();

        return new self($message, $code, $response);
    }

    /**
     * Format a value as a string safely
     *
     * @param mixed $value
     * @return string
     */
    private static function formatValue(mixed $value): string
    {
        if (is_string($value)) {
            return $value;
        }

        if (is_null($value)) {
            return 'null';
        }

        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        if (is_scalar($value)) {
            return (string)$value;
        }

        if (is_array($value) || is_object($value)) {
            try {
                return json_encode($value, JSON_THROW_ON_ERROR) ?: '[Encoding failed]';
            } catch (\JsonException $e) {
                return '[Invalid JSON]';
            }
        }

        return '[Unknown type]';
    }
}
