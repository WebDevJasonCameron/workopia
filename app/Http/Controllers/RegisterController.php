<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    /** Show Register form
     * 
     * 
     * @return view
     */
    public function register(): View
    {
        return view('auth.register');
    }
}
