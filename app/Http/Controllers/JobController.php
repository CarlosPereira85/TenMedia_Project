<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application; // Ensure Application model is imported
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

    public function applyForm(Job $job)
    {
        // Display the apply form for the job
        return view('jobs.apply', compact('job'));
    }

    public function apply(Request $request, Job $job)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf,doc,docx',
            'cover_letter' => 'required',
        ]);

        $user = Auth::user(); // Get the authenticated user

        // Store application with user_id and job_id
        $application = new Application();
        $application->user_id = $user->id;
        $application->job_id = $job->id;
        $application->resume = $request->file('resume')->store('resumes'); // Example storage path
        $application->cover_letter = $request->input('cover_letter');
        $application->save();

        return redirect()->route('jobs.show', $job->id)->with('success', 'Application submitted successfully.');
    }

    public function userAppliedJobs()
    {
        $user = Auth::user();
        $appliedJobs = $user->applications()->with('job')->paginate(10);

        return view('users.home', compact('appliedJobs'));
    }
}
