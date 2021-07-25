@extends('layouts.app')

@section('content')
<h1 class="display-6">{{ $page_title }}</h1>
<a href="#" data-target="#modalAddClient" data-toggle="modal" class="btn btn-primary"><i class="fas fa-plus"></i> Add</a>
@include('includes.modals.location.add')

<a href="{{ route('locations.index') }}" class="btn btn-primary"><i class="fas fa-sync"></i> Refresh List</a>

<form action="/locations/search" method="POST" class="form-inline d-inline-flex">
    {{ Form::token() }}
    <div class="input-group">
        <div class="input-group-prepend">
            <button class="btn btn-primary" type="submit" id="button-search"><i class="fas fa-search"></i> Search</button>
        </div>
        <input type="text" name="search" class="form-control" placeholder="...">
    </div>
</form>

<table class="table table-sm table-hover table-striped table-bordered mt-3">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Company</th>
            <th>Code</th>
            <th>Person</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Address</th>
            <th>Status</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($locations as $location)
        <tr>
            <th>{{ $loop->index + 1}}</th>
            <td>{{ $location->name }}</td>
            <td>{{ $location->company->code }}</td>
            <td>{{ $location->location_code }}</td>
            <td>{{ $location->contact_person }}</td>
            <td>{{ $location->contact_no }}</td>
            <td>{{ $location->email }}</td>
            <td>{{ $location->address }}</td>
            <td>{{ $location->status ? 'Active' : 'Inactive' }}</td>
            <td class="table-option">
                
                <a href="#" data-toggle="modal" data-target="#modalUpdate{{ $location->id }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                @include('includes.modals.location.update')

                {{-- <a href="#" data-target="#modalDeleteLocation" data-toggle="modal" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                @include('includes.modals.location.delete') --}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
