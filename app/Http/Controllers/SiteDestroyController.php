<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class SiteDestroyController extends Controller
{
    public function __invoke(Request $request, Site $site)
    {
        $site->delete();

        redirect()->route('dashboard');
    }
}
