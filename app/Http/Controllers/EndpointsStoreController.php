<?php

namespace App\Http\Controllers;

use App\Http\Requests\EndpointStoreRequest;
use App\Models\Site;
use Illuminate\Http\Request;

class EndpointsStoreController extends Controller
{
    public function __invoke(EndpointStoreRequest $request, Site $site)
    {
        $site->endpoints()->create($request->only('location', 'frequency'));

        return back();
    }
}
