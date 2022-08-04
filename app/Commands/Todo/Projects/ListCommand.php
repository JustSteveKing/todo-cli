<?php

declare(strict_types=1);

namespace App\Commands\Todo\Projects;

use App\Contracts\TodoContract;
use App\DataObjects\Project;
use LaravelZero\Framework\Commands\Command;
use Throwable;

final class ListCommand extends Command
{
    protected $signature = 'projects:list';

    protected $description = 'List out Projects from the Todoist API.';

    public function handle(
        TodoContract $client,
    ): int {
        try {
            $projects = $client->projects()->list();
        } catch (Throwable $exception) {
            $this->warn(
                string: $exception->getMessage(),
            );

            return ListCommand::FAILURE;
        }

        $this->table(
            headers: ['ID', 'Project Name', 'Comments Count', 'Shared', 'URL'],
            rows: $projects->map(fn (Project $project): array => $project->toArray())->toArray(),
        );

        return ListCommand::SUCCESS;
    }
}
