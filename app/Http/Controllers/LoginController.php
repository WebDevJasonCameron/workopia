<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /** Show Login User
     * 
     * @route POST "/login"
     * @return view
     */
    public function login(): View
    {
        return view('auth.login');
    }

    /** Authenticate User
     * 
     * @route PUT "/register"
     * @param Request $request
     * @return RedirectResponse
     */
    public function authenticate(Request $request): RedirectResponse
    {
        // Validation
        $credentials = $request->validate(([
            'email' => 'required|string|email|max:100',
            'password' => 'required|string',
        ]));

        // Attempt to auth user
        if (Auth::attempt($credentials)) {
            // Regenerate the session to prevent fixation attacks
            $request->session()->regenerate();

            return redirect()->intended(route('home'))->with('success', 'You are now logged in!');
        }

        // If auth fails, redirect with error
        return back()->withErrors([
            'email' => 'Tjhe provided credentials do not match our records',
        ])->onlyInput('email');
    }

    /** Show Logout User
     * 
     * @route POST "/lougout"
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        // Invalidate Session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
