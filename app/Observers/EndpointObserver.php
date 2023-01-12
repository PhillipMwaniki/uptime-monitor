<?php

namespace App\Observers;

use App\Models\Endpoint;
use Arr;

class EndpointObserver
{
    public function creating(Endpoint $endpoint): void
    {
        $parsed = parse_url($endpoint->site->url() . '/' . $endpoint->location);

        $endpoint->location = '/' . trim(trim(Arr::get($parsed, 'path'), '/') . '?' .  Arr::get($parsed, 'query'), '?');

        $endpoint->next_check = now()->addSeconds($endpoint->frequency);
    }
}
