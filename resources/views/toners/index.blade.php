@extends('layouts.app')

@section('content')
<h1 class="display-6">{{ $page_title }}</h1>
@can('toner-create')
    <a href="#" data-target="#modalAddToner" data-toggle="modal" class="btn btn-primary"><i class="fas fa-plus"></i> Add</a>
    @include('includes.modals.toner.add')
@else
    <button class="btn btn-secondary"><i class="fas fa-plus"></i> Add</button>
@endcan

<a href="{{ route('toners.index') }}" class="btn btn-primary"><i class="fas fa-sync"></i> Refresh List</a>

<form action="/toners/search" method="POST" class="form-inline d-inline-flex">
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
            <th>Model</th>
            <th>Type</th>
            <th>Unit</th>
            <th>ROP</th>
            <th>Status</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($toners as $toner)
        <tr>
            <th>{{ $loop->index + 1}}</th>
            <td>{{ $toner->model_name }}</td>
            <td>{{ $toner->toner_type->name }}</td>
            <td>{{ $toner->unit->name }}</td>
            <td>{{ $toner->minimum_quantity }}</td>
            <td>{{ $toner->status ? 'Active' : 'Inactive' }}</td>
            <td class="table-option">
                
                @can('toner-edit')
                <a href="#" data-toggle="modal" data-target="#modalUpdateToner{{ $toner->id }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                @include('includes.modals.toner.update')
                @else
                <button class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></button>
                @endcan
                {{-- <a href="#" data-target="#modal{{ $toner->id }}" data-toggle="modal" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a> --}}
                
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6"><center>No result found.</center></td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- <div class="d-flex">
    {{ $toners->links() }}
</div> --}}
@endsection
