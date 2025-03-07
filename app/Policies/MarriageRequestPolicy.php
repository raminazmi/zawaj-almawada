<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MarriageRequest;

class MarriageRequestPolicy
{
    public function respond(User $user, MarriageRequest $request)
    {
        return $user->id === $request->target_user_id;
    }
}
