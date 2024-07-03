<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


  
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

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
}


