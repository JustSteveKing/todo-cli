<?php

declare(strict_types=1);

namespace App\DataObjects;

use JustSteveKing\DataObjects\Contracts\DataObjectContract;

final class Project implements DataObjectContract
{
    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly int $comments,
        private readonly string $url,
        private readonly bool $shared,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'comments' => $this->comments,
            'shared' => $this->shared ? 'true' : 'false',
            'url' => $this->url,
        ];
    }
}
