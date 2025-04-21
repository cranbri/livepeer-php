<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Requests\Task;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetTaskRequest extends Request
{
    /**
     * The HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    /**
     * Create a new GetTaskRequest instance
     *
     * @param string $taskId
     */
    public function __construct(protected string $taskId)
    {}

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "/task/{$this->taskId}";
    }
}
