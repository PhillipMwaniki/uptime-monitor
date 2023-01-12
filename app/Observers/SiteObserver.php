<?php

namespace App\Observers;

use App\Models\Site;

class SiteObserver
{

    public function creating(Site $site): void
    {
        $parsed = parse_url($site->domain);

        $site->scheme = $parsed['scheme'];
        $site->domain = $parsed['host'] . ':' . $parsed['port'];
    }
    public function updating(Site $site): void
    {
        if (array_key_exists('default', $site->getDirty())) {
            $site->user->sites()->whereNot('id', $site->id)->update(['default' => false]);
        }
    }
}
