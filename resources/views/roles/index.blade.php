@extends('layouts.app')

@section('content')
<h1 class="display-6">{{ $page_title ?? 'Page Title'}}</h1>
<a href="#" data-toggle="modal" data-target="#modalAddRole" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Create</a>
@include('includes.modals.roles.add')

<table class="table table-sm table-hover table-striped table-hovered">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($roles as $role)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $role->name }}</td>
            <td>{{ $role->description ?? 'N/A' }}</td>
            <td>
                <a href="#" data-target="#modalViewRole{{ $role->id }}" data-toggle="modal" class="btn btn-sm btn-success"><i class="fas fa-info"></i></a>
                @include('includes.modals.roles.show')
                <a href="#" data-target="#modalUpdateRole{{ $role->id }}" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                @include('includes.modals.roles.update')
            </td>
        </tr>
        @empty
            <tr>
                <td colspan="3"><center>No record found.</center></td>
            </tr>
        @endforelse
    </tbody>
</table>




@endsection
