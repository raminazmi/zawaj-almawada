<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MarriageRequest;

class UserPolicy
{
    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $viewer The user who is trying to view the profile
     * @param  \App\Models\User  $profileUser The user whose profile is being viewed
     * @return bool
     */
    public function view(User $viewer, User $profileUser): bool
    {
        // Users can always view their own profile.
        if ($viewer->id === $profileUser->id) {
            return true;
        }

        // If the profile user has set their profile to be public, anyone can view it.
        if ($profileUser->show_profile) {
            return true;
        }

        // If the profile user is a female and has a private profile,
        // only a user to whom she has sent a marriage request can view her profile.
        if ($profileUser->gender === 'female' && !$profileUser->show_profile) {
            return MarriageRequest::where('user_id', $profileUser->id)
                ->where('target_user_id', $viewer->id)
                ->exists();
        }

        // By default, deny viewing.
        return false;
    }
}
