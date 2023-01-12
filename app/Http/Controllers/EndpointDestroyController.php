<?php

namespace App\Http\Controllers;

use App\Http\Requests\EndpointDestroyRequest;
use App\Models\Endpoint;
use App\Models\Site;
use Illuminate\Http\Request;

class EndpointDestroyController extends Controller
{
    public function __invoke(EndpointDestroyRequest $request, Endpoint $endpoint)
    {
        $endpoint->delete();

        return back();
    }
}
