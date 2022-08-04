<?php

declare(strict_types=1);

namespace App\Services\Concerns;

use App\Exceptions\TodoApiException;
use App\Services\Enums\Method;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

trait SendsRequests
{
    public function send(
        Method $method,
        string $uri,
        null|array $data = null,
    ): Response {
        $request = $this->makeRequest();

        $response = $request->send(
            method: $method->value,
            url: $uri,
            options: $data ? ['json' => $data] : [],
        );

        if ($response->failed()) {
            throw new TodoApiException(
                response: $response,
            );
        }

        return $response;
    }

    protected function makeRequest(): PendingRequest
    {
        return Http::baseUrl(
            url: $this->client->url,
        )->timeout(
            seconds: 15,
        )->withToken(
            token: $this->client->token,
        )->withUserAgent(
            userAgent: 'todo-cli',
        );
    }
}
