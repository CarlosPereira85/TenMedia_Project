<?php



namespace App\Policies;

use App\Models\User;
use App\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user, Category $category)
    {
        // Allow all users to view categories
        return true;
    }

    public function create(User $user)
    {
        // Only allow users with the 'admin' role to create categories
        return $user->role === 'admin';
    }

    public function update(User $user, Category $category)
    {
        // Only allow users with the 'admin' role to update categories
        return $user->role === 'admin';
    }

    public function delete(User $user, Category $category)
    {
        // Only allow users with the 'admin' role to delete categories
        return $user->role === 'admin';
    }
}
