<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $search = request('search');
        $companies = auth()->user()->companies()->withCount('contacts')->latest()->paginate(1);
        return view('companies.index', compact('companies', 'search'));
    }

    public function create()
    {
        $company = new Company();
        return view('companies.create', compact('company'));
    }

    public function store(CompanyRequest $request)
    {
        auth()->user()->companies()->create($request->all());
        return redirect()->route('companies.index')->with('message', 'Company has been created successfully.');
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(CompanyRequest $request, Company $company)
    {
        $data = $request->all();

        $company->update($data);

        return redirect()
            ->route('companies.index')
            ->with('message', 'Company has been updated successfully.');
    }

    public function destroy(Company $company)
    {
        $company->destroy($company->id);

        return redirect()
            ->route('companies.index')
            ->with('message', 'Company has been deleted successfully.');
    }
}
