<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    /** Show Register form
     * 
     * @route GET "/register"
     * @return view
     */
    public function register(): View
    {
        return view('auth.register');
    }

    /** Store Register form
     * 
     * @route PUT "/register"
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation
        $validatedData = $request->validate(([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]));

        // Hash pw
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create User
        $user = User::create($validatedData);

        // Redirect
        return redirect()->route('login')->with('success', 'You are registered and can log in.');
    }
}
