<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteStoreController extends Controller
{
    public function __invoke(Request $request)
    {
        $site = $request->user()->sites()->create($request->only(['domain']));

        return redirect()->route('dashboard', $site);

    }
}
