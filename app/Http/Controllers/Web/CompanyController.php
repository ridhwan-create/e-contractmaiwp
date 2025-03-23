<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->paginate(10);
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'required|string|unique:companies|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:companies',
        ]);

        Company::create([
            'name' => $request->name,
            'registration_number' => $request->registration_number,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => "required|string|max:255|unique:companies,registration_number,{$company->id}",
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => "required|email|unique:companies,email,{$company->id}",
        ]);

        $company->update([
            'name' => $request->name,
            'registration_number' => $request->registration_number,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'edited_by' => Auth::id(),
        ]);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
