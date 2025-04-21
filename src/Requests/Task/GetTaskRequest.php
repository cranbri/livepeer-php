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
     * The task ID
     *
     * @var string
     */
    protected string $taskId;

    /**
     * Create a new GetTaskRequest instance
     *
     * @param string $taskId
     */
    public function __construct(string $taskId)
    {
        $this->taskId = $taskId;
    }

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
