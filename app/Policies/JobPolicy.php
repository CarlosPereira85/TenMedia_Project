<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Job;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user, Job $job)
    {
        // Allow all users to view jobs
        return true;
    }

    public function create(User $user)
    {
        // Only allow users with the 'admin' role to create jobs
        return $user->role === 'admin';
    }

    public function update(User $user, Job $job)
    {
        // Only allow users with the 'admin' role to update jobs
        return $user->role === 'admin';
    }

    public function delete(User $user, Job $job)
    {
        // Only allow users with the 'admin' role to delete jobs
        return $user->role === 'admin';
    }
}
