<?php

declare(strict_types=1);

namespace App\Contracts;

interface ConfigurationContract
{
    public function all(): array;

    public function clear(): ConfigurationContract;

    public function get(string $key, mixed $default = null): array|int|string|null;

    public function set(string $key, array|int|string $value): ConfigurationContract;
}
