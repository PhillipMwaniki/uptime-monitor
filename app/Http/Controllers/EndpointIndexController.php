<?php

namespace App\Http\Controllers;

use App\Http\Resources\EndpointResource;
use App\Models\Endpoint;
use Illuminate\Http\Request;

class EndpointIndexController extends Controller
{
    public function __construct() { }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke(Endpoint $endpoint)
    {
        $this->authorize('show', $endpoint);

        return inertia()->render('Endpoint', [
            'endpoint' => EndpointResource::make($endpoint)
        ]);
    }
}
