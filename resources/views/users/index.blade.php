@extends('layouts.app')

@section('content')
<h1 class="display-6">{{ $page_title ?? 'Page Title'}}</h1>
<a href="#" data-target="#modalCreateUser" data-toggle="modal" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Add</a>
@include('includes.modals.user.add')

<table class="table table-sm table-hover table-striped table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Roles</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $user)
        <tr>
            <th>{{ $loop->index + 1 }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $role)
                    <label class="badge badge-primary">{{ $role }}</label>
                    @endforeach
                @endif
            </td>
            <td>
                <a href="#" data-toggle="modal" data-target="#modalUpdateUser{{ $user->id }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                @include('includes.modals.user.update')
                <a href="#" data-toggle="modal" data-target="#modalResetPasswordUser{{ $user->id }}" class="btn btn-sm btn-danger"><i class="fas fa-key"></i> Reset Password</a>
                @include('includes.modals.user.reset-password')
            </td>
        </tr>
        @empty
            
        @endforelse
    </tbody>
</table>

@endsection
