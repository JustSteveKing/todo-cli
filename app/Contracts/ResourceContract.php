<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Services\Enums\Method;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use JustSteveKing\DataObjects\Contracts\DataObjectContract;

interface ResourceContract
{
    public function list(): Collection;

    public function get(string $identifier): DataObjectContract;

    public function create(DataObjectContract $resource): DataObjectContract;

    public function update(string $identifier, DataObjectContract $payload): DataObjectContract;

    public function delete(string $identifier): bool;

    public function send(
        Method $method,
        string $uri,
        null|array $data = null,
    ): Response;
}
