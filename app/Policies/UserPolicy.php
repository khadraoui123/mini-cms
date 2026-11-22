<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can change another user's role.
     */
    public function updateRole(User $user, User $target): bool
    {
        return $user->id !== $target->id;
    }
}
