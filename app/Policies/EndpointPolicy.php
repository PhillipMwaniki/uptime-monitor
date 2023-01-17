<?php

namespace App\Policies;

use App\Models\Endpoint;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EndpointPolicy
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

    public function destroy(User $user, Endpoint $endpoint): bool
    {
        return $endpoint->site->user_id === $user->id;
    }

    public function show(User $user, Endpoint $endpoint): bool
    {
        return $endpoint->site->user_id === $user->id;
    }

    public function update(User $user, Endpoint $endpoint): bool
    {
        return $endpoint->site->user_id === $user->id;
    }


}
