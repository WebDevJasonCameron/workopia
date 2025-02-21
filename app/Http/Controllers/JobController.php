<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;

class JobController extends Controller
{
    /** Display a listing of the resource.
     * 
     * 
     * @return view
     */
    public function index(): view
    {
        $jobs = Job::all();

        return view('jobs.index')->with('jobs', $jobs);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return view
     */
    public function create(): view
    {
        return view('jobs.create');
    }

    /** Store a newly created resource in storage.
     * 
     * 
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
        $validatedData['user_id'] = 1;

        Job::create($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job listing created successfully!');
    }

    /** Display the specified resource.
     * 
     * 
     * @return view
     */
    public function show(Job $job): view
    {
        return view('jobs.show')->with('job', $job);
    }

    /** Show the form for editing the specified resource.
     * 
     * 
     * @param string $id
     * @return string
     */
    public function edit(string $id): string
    {
        return 'edit';
    }

    /** Update the specified resource in storage.
     * 
     * 
     * @param Request $request
     * @param string $id
     * @return string
     */
    public function update(Request $request, string $id): string
    {
        return 'update';
    }

    /** Remove the specified resource from storage.
     * 
     * 
     * @param string $id
     * @return string
     */
    public function destroy(string $id): string
    {
        return 'destroy';
    }
}
