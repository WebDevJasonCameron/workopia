<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboradController extends Controller
{
    /** Show all users job Listings in Dashboard
     * 
     * @route GET "/dashboard"
     * @return view
     */
    public function index(): View
    {

        // Get logged in user
        $user = Auth::user();

        // Get the user listings
        $jobs = Job::where('user_id', $user->id)->get();

        return view('dashboard.index', compact('user', 'jobs'));
    }
}
