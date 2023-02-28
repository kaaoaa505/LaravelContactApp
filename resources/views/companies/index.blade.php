@extends('_layouts.main')

@section('title', 'Contact App | All Companies')

@section('content')

    <!-- content -->
    <main class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-title">
                            <div class="d-flex align-items-center">
                                <h2 class="mb-0">All Companies</h2>
                                <div class="ml-auto">
                                    <a href="{{ route('companies.create') }}" class="btn btn-success"><i
                                            class="fa fa-plus-circle"></i> Add New</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            @include('companies._filter')

                            @if (Session::has('message'))
                                <div class="alert alert-success">
                                    {{ Session::get('message') }}
                                </div>
                            @endif

                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Website</th>
                                        <th scope="col">Contacts</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if ($companies->count() > 0)
                                        @foreach ($companies as $index => $company)
                                            <tr>
                                                <th scope="row">{{ $index + $companies->firstItem() }}</th>
                                                <td>{{ $company->name }}</td>
                                                <td>{{ $company->email }}</td>
                                                <td>{{ $company->address }}</td>
                                                <td>{{ $company->website }}</td>
                                                {{-- <td>{{ $company->contacts->count() }}</td> --}}
                                                <td>{{ $company->contacts_count }}</td>
                                                <td width="150">
                                                    <a href="{{ route('companies.show', $company->id) }}"
                                                        class="btn btn-sm btn-circle btn-outline-info" title="Show"><i
                                                            class="fa fa-eye"></i></a>

                                                    <a href="{{ route('companies.edit', $company->id) }}"
                                                        class="btn btn-sm btn-circle btn-outline-secondary"
                                                        title="Edit"><i class="fa fa-edit"></i></a>

                                                    <form action="{{ route('companies.destroy', $company->id) }}"
                                                        method="post" class="d-inline">

                                                        @csrf
                                                        @method('delete')

                                                        <button id="delete_btn" type="submit"
                                                            class="btn btn-sm btn-circle btn-outline-danger" title="Delete"
                                                            onclick="if(confirm('Are you sure?')){
                                                            return true;
                                                        }else{
                                                            return false;
                                                        }"><i
                                                                class="fa fa-times"></i></button>

                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>

                            {{ $companies->appends(compact('search'))->links('pagination::bootstrap-4') }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
