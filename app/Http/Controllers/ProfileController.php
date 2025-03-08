<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,giv|max:2048',
        ]);

        // Get user name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Handle avatar uploads
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::delete('public/' . $user->avatar);
            }
            // Store new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        // Update user info
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Profile info updated!');
    }
}
