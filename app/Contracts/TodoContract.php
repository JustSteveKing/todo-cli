<?php

declare(strict_types=1);

namespace App\Contracts;

interface TodoContract
{
    public function projects(): ResourceContract;

    public function tasks(): ResourceContract;
}
