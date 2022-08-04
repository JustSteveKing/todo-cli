<?php

declare(strict_types=1);

namespace App\Services\Todoist\Resources;

use App\Contracts\ResourceContract;
use App\Contracts\TodoContract;
use App\DataObjects\Project;
use App\Services\Concerns\SendsRequests;
use App\Services\Enums\Method;
use Illuminate\Support\Collection;
use JustSteveKing\DataObjects\Contracts\DataObjectContract;
use JustSteveKing\DataObjects\Facades\Hydrator;

final class ProjectResource implements ResourceContract
{
    use SendsRequests;

    public function __construct(
        private readonly TodoContract $client,
    ) {}

    public function list(): Collection
    {
        $response = $this->send(
            method: Method::GET,
            uri: '/projects',
        );

        return (new Collection(
            items: $response->json(),
        ))->map(
            callback: fn (array $project): DataObjectContract =>
                Hydrator::fill(
                    class: Project::class,
                    properties: [
                        'id' => $project['id'],
                        'name' => $project['name'],
                        'comments' => $project['comment_count'],
                        'url' => $project['url'],
                        'shared' => $project['shared'],
                    ],
                )
            ,
        );
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
