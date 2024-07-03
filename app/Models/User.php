<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Delete the authenticated user's account.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAccount()
    {
        $user = Auth::user();

        // Optionally, logout the user first
        Auth::logout();

        // Delete the user account
        $user->delete();

        return redirect('/')->with('success', 'Your account has been deleted.');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Define the applications relationship
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
