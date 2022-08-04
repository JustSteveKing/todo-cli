<?php

declare(strict_types=1);

namespace App\Commands\Todo;

use App\Contracts\ConfigurationContract;
use LaravelZero\Framework\Commands\Command;

final class LoginCommand extends Command
{
    protected $signature = 'login';

    protected $description = 'Store your API credentials for the Todoist API.';

    public function handle(ConfigurationContract $config): int
    {
        $token = $this->secret(
            question: 'What is your Todoist API token?',
        );

        if (! $token) {
            $this->warn(
                string: "You need to supply an API token to use this application.",
            );

            return LoginCommand::FAILURE;
        }

        $config->clear()->set(
            key: 'token',
            value: $token,
        )->set(
            key: 'url',
            value: 'https://api.todoist.com/rest/v1',
        );

        $this->info(
            string: 'We have successfully stored your API token for Todoist.',
        );

        return LoginCommand::SUCCESS;
    }
}
