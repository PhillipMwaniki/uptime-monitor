<?php

namespace App\Http\Controllers;

use App\Http\Requests\EndpointUpdateRequest;
use App\Models\Endpoint;
use Illuminate\Http\Request;

class EndpointUpdateController extends Controller
{
    public function __invoke(EndpointUpdateRequest $request, Endpoint $endpoint)
    {
        $endpoint->update($request->only('location', 'frequency'));
    }
}
