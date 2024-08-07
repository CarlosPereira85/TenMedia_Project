<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserHomeController extends Controller
{
    /**
     * Show the user's home page.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
        }

        // Fetch authenticated user
        $user = auth()->user();

        // Fetch the user's applications
        $applications = $user->applications()->with('job')->get();

        // Pass user and applications data to the view
        return view('users.home', compact('user', 'applications'));
    }

    /**
     * Delete the authenticated user's account.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAccount()
    {
        // Fetch authenticated user
        $user = Auth::user();

        // Optionally, logout the user first
        Auth::logout();

        // Delete the user account
        $user->delete();

        return redirect('/')->with('success', 'Your account has been deleted.');
    }
}
