<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Job;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
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

    /**
     * Store a newly created resource in storage.
     * 
     * @param Request $request
     * @return string
     */
    public function store(Request $request): string
    {
        return 'store';
    }

    /**
     * Display the specified resource.
     * 
     * @return string
     */
    public function show(string $id): string
    {
        return 'show';
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param string $id
     * @return string
     */
    public function edit(string $id): string
    {
        return 'edit';
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param Request $request
     * @param string $id
     * @return string
     */
    public function update(Request $request, string $id): string
    {
        return 'update';
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param string $id
     * @return string
     */
    public function destroy(string $id): string
    {
        return 'destroy';
    }
}
