<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    /** Show Login form
     * 
     * 
     * @return view
     */
    public function login(): View
    {
        return view('auth.login');
    }
}
