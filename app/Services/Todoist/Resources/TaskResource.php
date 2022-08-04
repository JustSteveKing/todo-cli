<?php

declare(strict_types=1);

namespace App\Services\Todoist\Resources;

use App\Contracts\ResourceContract;
use App\Contracts\TodoContract;
use Illuminate\Support\Collection;
use JustSteveKing\DataObjects\Contracts\DataObjectContract;

final class TaskResource implements ResourceContract
{
    public function __construct(
        private readonly TodoContract $client,
    ) {}

    public function list(): Collection
    {
        // TODO: Implement list() method.
    }

    public function get(string $identifier): DataObjectContract
    {
        // TODO: Implement get() method.
    }

    public function create(DataObjectContract $resource): DataObjectContract
    {
        // TODO: Implement create() method.
    }

    public function update(string $identifier, DataObjectContract $payload): DataObjectContract
    {
        // TODO: Implement update() method.
    }

    public function delete(string $identifier): bool
    {
        // TODO: Implement delete() method.
    }
}
