<?php

namespace App\Policies;

use App\Models\Site;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SitePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function storeEndpoint(User $user, Site $site): bool
    {

        return $user->id === $site->user_id;

    }

    public function canStoreNotificationChannels(User $user, Site $site): bool
    {

        return $user->id === $site->user_id;

    }
}
