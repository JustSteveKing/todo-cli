<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\ConfigurationContract;
use App\Contracts\TodoContract;
use App\Repositories\LocalConfiguration;
use App\Services\Todoist\TodoistClient;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ConfigurationContract::class => LocalConfiguration::class,
    ];

    public function register(): void
    {
        $this->app->singleton(
            abstract: LocalConfiguration::class,
            concrete: static function (): LocalConfiguration {
                $path = isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'testing'
                    ? base_path(path: 'tests')
                    : ($_SERVER['HOME'] ?? $_SERVER['USERPROFILE']);

                return new LocalConfiguration(
                    path: "$path/.todo/config.json",
                );
            },
        );

        $this->app->singleton(
            abstract: TodoContract::class,
            concrete: static function (): TodoContract {
                $config = app()->make(
                    abstract: ConfigurationContract::class,
                );

                return new TodoistClient(
                    url: $config->get(
                        key: 'url',
                    ),
                    token: $config->get(
                        key: 'token',
                    ),
                );
            },
        );
    }
}
