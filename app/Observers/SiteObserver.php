<?php

namespace App\Observers;

use App\Models\Site;

class SiteObserver
{
    public function updating(Site $site): void
    {
        if (array_key_exists('default', $site->getDirty())) {
            $site->user->sites()->whereNot('id', $site->id)->update(['default' => false]);
        }
    }
}
