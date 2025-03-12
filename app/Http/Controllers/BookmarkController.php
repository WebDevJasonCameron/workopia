<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Job;

class BookmarkController extends Controller
{
    /** Get all user's buookmarks
     * 
     * @route GET "/bookmarks"
     * @return view
     */
    public function index(): View
    {
        $user = Auth::user();

        $bookmarks = $user->bookmarkedJobs()->orderBy('job_user_bookmarks.created_at', 'desc')->paginate(9);
        return view('jobs.bookmarked')->with('bookmarks', $bookmarks);
    }

    /** Create new bookmark
     * 
     * @route POST "/bookmarks/{job}"
     * @param Job $job
     * @return RedirectResponse
     */
    public function store(Job $job): RedirectResponse
    {
        $user = Auth::user();

        // Check if the job is already bookmarked
        if ($user->bookmarkedJobs()->where('job_id', $job->id)->exists()) {
            return back()->with('error', 'Job is already bookmarked');
        }

        // Create new Bookmared 
        $user->bookmarkedJobs()->attach($job->id);

        return back()->with('success', 'Job bookmarked successfully!');
    }

    /** Remove bookmark job
     * 
     * @route DELETE "/bookmarks/{job}"
     * @param Job $job
     * @return RedirectResponse
     */
    public function destroy(Job $job): RedirectResponse
    {
        $user = Auth::user();

        // Check if the job is not bookmarked
        if (!$user->bookmarkedJobs()->where('job_id', $job->id)->exists()) {
            return back()->with('error', 'Job is not bookmarked');
        }

        // Remove bookmared 
        $user->bookmarkedJobs()->detach($job->id);

        return back()->with('success', 'Bookmarked removed successfully!');
    }
}
