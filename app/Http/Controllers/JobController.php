<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;                         // Lets you replace image
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Job;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Foundation\Auth\Access\Authorizable;

class JobController extends Controller
{

    use AuthorizesRequests;

    /** Display a listing of the resource.
     * 
     * @route GET "/jobs"
     * @return view
     */
    public function index(): view
    {
        $jobs = Job::all();

        return view('jobs.index')->with('jobs', $jobs);
    }

    /** Show the form for creating a new resource.
     *
     * @route GET "/jobs/create"
     * @return view
     */
    public function create(): view
    {
        return view('jobs.create');
    }

    /** Store a newly created resource in storage.
     * 
     * @route POST "/jobs"
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'required|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_website' => 'nullable|url',
        ]);

        // Hardcoded user ID
        $validatedData['user_id'] = auth()->user()->id;

        // Check for image
        if ($request->hasFile('company_logo')) {
            // Store the file and get path
            $path = $request->file('company_logo')->store('logos', 'public');

            // Add path to validated data
            $validatedData['company_logo'] = $path;
        }


        // Submit to database
        Job::create($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job listing created successfully!');
    }

    /** Display the specified resource.
     * 
     * @route GET "/jobs/{$id}"
     * @return view
     */
    public function show(Job $job): view
    {
        return view('jobs.show')->with('job', $job);
    }

    /** Show the form for editing the specified resource.
     * 
     * @route GET "/jobs/{$id}/edit"
     * @param Job $job
     * @return View
     */
    public function edit(Job $job): View
    {
        // Check if user is authorized
        $this->authorize('update', $job);

        return view('jobs.edit')->with('job', $job);
    }

    /** Update the specified resource in storage.
     * 
     * @route PUT "/jobs/{$id}"
     * @param Request $request
     * @param Job $job
     * @return RedirectResponse
     */
    public function update(Request $request, Job $job): RedirectResponse
    {
        // Check if user is authorized
        $this->authorize('update', $job);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'required|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_website' => 'nullable|url',
        ]);

        // Check for image
        if ($request->hasFile('company_logo')) {
            // Delete old logo
            Storage::delete('public/logos/' . basename($job->company_logo));

            // Store the file and get path
            $path = $request->file('company_logo')->store('logos', 'public');

            // Add path to validated data
            $validatedData['company_logo'] = $path;
        }

        // Submit to database
        $job->update($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job listing updated successfully!');
    }

    /** Remove the specified resource from storage.
     * 
     * @route DELETE "/jobs/{$id}"
     * @param Job $job)
     * @return  RedirectResponse
     */
    public function destroy(Job $job): RedirectResponse
    {

        // Check if user is authorized
        $this->authorize('delete', $job);

        // If logo, then delete it
        if ($job->company_logo) {
            Storage::delete('public/logos' . $job->company_logo);
        }

        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job listing deleted successfully!');
    }
}
