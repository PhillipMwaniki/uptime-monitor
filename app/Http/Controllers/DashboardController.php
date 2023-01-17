<?php

namespace App\Http\Controllers;

use App\Enums\EndpointFrequency;
use App\Http\Resources\EndpointFrequencyResource;
use App\Http\Resources\EndpointResource;
use App\Http\Resources\SiteResource;
use App\Models\Site;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request, Site $site)
    {

        if (!$site->exists) {
            $site = auth()->user()?->sites()->whereDefault(true)->first() ?? auth()->user()?->sites()->first();
        }

        $site->update(['default' => true]);

        return inertia()->render('Dashboard', [
            'site' => SiteResource::make($site),
            'endpoints' => EndpointResource::collection($site->endpoints),
        ]);
    }
}
