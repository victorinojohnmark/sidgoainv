@extends('layouts.app')

@section('content')
<h1 class="display-6">{{ $page_title }}</h1>
<a href="#" data-target="#modalAddSupplier" data-toggle="modal" class="btn btn-primary"><i class="fas fa-plus"></i> Add</a>
@include('includes.modals.supplier.add')

<a href="{{ route('suppliers.index') }}" class="btn btn-primary"><i class="fas fa-sync"></i> Refresh List</a>

<form action="/suppliers/search" method="POST" class="form-inline d-inline-flex">
    {{ Form::token() }}
    <div class="input-group">
        <div class="input-group-prepend">
            <button class="btn btn-primary" type="submit" id="button-search"><i class="fas fa-search"></i> Search</button>
        </div>
        <input type="text" name="search" class="form-control" placeholder="...">
    </div>
</form>

<table class="table table-sm table-hover table-striped mt-3">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
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
        @foreach ($suppliers as $supplier)
        <tr>
            <th>{{ $loop->index + 1}}</th>
            <td>{{ $supplier->name }}</td>
            <td>{{ $supplier->vendor_code }}</td>
            <td>{{ $supplier->contact_person }}</td>
            <td>{{ $supplier->contact_no }}</td>
            <td>{{ $supplier->email }}</td>
            <td>{{ $supplier->address }}</td>
            <td>{{ $supplier->status ? 'Active' : 'Inactive' }}</td>
            <td class="table-option">
                
                <a href="#" data-toggle="modal" data-target="#modalUpdate{{ $supplier->id }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                @include('includes.modals.supplier.update')

                {{-- <a href="#" data-target="#modalDeleteSupplier{{ $supplier->id }}" data-toggle="modal" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                @include('includes.modals.supplier.delete') --}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
