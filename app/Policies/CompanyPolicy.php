<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Company;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true; // Allow all users to view companies
    }

    public function create(User $user)
    {
        return $user->role === 'Admin'; // Only admin can create companies
    }

    public function update(User $user, Company $company)
    {
        return $user->role === 'Admin'; // Only admin can update companies
    }

    public function delete(User $user, Company $company)
    {
        return $user->role === 'Admin'; // Only admin can delete companies
    }
}
