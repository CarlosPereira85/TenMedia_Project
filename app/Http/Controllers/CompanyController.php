<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::paginate(10);
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('companies.index')->with('error', 'You are not authorized to create a company.');
        }

        return view('companies.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('companies.index')->with('error', 'You are not authorized to create a company.');
        }

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
        ]);

        Company::create($request->all());

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('companies.index')->with('error', 'You are not authorized to edit this company.');
        }

        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('companies.index')->with('error', 'You are not authorized to update this company.');
        }

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
        ]);

        $company->update($request->all());

        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('companies.index')->with('error', 'You are not authorized to delete this company.');
        }

        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
