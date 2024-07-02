<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::paginate(10);
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to create a job.');
        }

        return view('jobs.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to create a job.');
        }

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'requirements' => 'required',
            'salary' => 'required|numeric',
            'location' => 'required',
            'company_id' => 'required|exists:companies,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        Job::create($request->all());

        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }

    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    public function edit(Job $job)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to edit this job.');
        }

        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to update this job.');
        }

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'requirements' => 'required',
            'salary' => 'required|numeric',
            'location' => 'required',
            'company_id' => 'required|exists:companies,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $job->update($request->all());

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
    }

    public function destroy(Job $job)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to delete this job.');
        }

        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }
}
