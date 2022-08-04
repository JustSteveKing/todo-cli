<?php

declare(strict_types=1);

namespace App\Services\Todoist;

use App\Contracts\ResourceContract;
use App\Contracts\TodoContract;
use App\Services\Todoist\Resources\ProjectResource;
use App\Services\Todoist\Resources\TaskResource;

final class TodoistClient implements TodoContract
{
    public function __construct(
        public readonly string $url,
        public readonly string $token,
    ) {}

    public function projects(): ResourceContract
    {
        return new ProjectResource(
            client: $this,
        );
    }

    public function tasks(): ResourceContract
    {
        return new TaskResource(
            client: $this,
        );
    }
}
