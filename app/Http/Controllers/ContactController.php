<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Company;
use App\Models\Contact;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $company_id = request('company_id');
        $search = request('search');

        $companies = Company::userCompanies();

        // $contacts = Contact::userContacts()->paginate(10);
        $contacts = Contact::userContacts()->with('company')->paginate(100);

        return view('contacts.index', compact('contacts', 'companies', 'company_id', 'search'));
    }

    public function create()
    {
        $companies = Company::userCompanies();

        $company_id = request('company_id');

        $contact = new Contact();

        return view('contacts.create', compact('companies', 'company_id', 'contact'));
    }

    public function store(ContactRequest $request)
    {
        $data = $request->all();

        Contact::create($data + ['user_id' => auth()->user()->id]);

        return redirect()
            ->route('contacts.index')
            ->with('message', 'Contact has been added successfully.');
    }

    public function edit(Contact $contact)
    {
        $companies = Company::userCompanies();

        $company_id = $contact->company->id;

        return view('contacts.edit', compact('companies', 'company_id', 'contact'));
    }

    public function update(Contact $contact, ContactRequest $request)
    {
        $data = $request->all();

        $contact->update($data);

        return redirect()
            ->route('contacts.index')
            ->with('message', 'Contact has been updated successfully.');
    }

    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        $contact->destroy($contact->id);

        return redirect()
            ->route('contacts.index')
            ->with('message', 'Contact has been deleted successfully.');
    }
}
