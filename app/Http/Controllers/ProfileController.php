<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /** Update profile info
     * 
     * @route PUT "/profile"
     * @param Request $request
     * @return  RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        // Get logged in user
        $user = Auth::user();

        // Validate Data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
        ]);

        // Update user info
        $user->update($validatedData);

        return redirect()->route('dashboard')->with('success', 'Profile info updated!');
    }
}
