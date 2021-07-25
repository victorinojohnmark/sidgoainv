@extends('layouts.app')

@section('content')
<h1 class="display-6">{{ $page_title ?? 'Page Title'}}</h1>
<a href="#" data-target="#modalAddSupplier" data-toggle="modal" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Add</a>



@endsection
