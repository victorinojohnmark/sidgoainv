@extends('layouts.app')

@section('content')

<h1 class="display-6 mb-3">Item Count</h1>
<a href="/" class="btn btn-sm btn-info text-white">On Stock</a> 
<a href="/lowstock" class="btn btn-sm btn-danger">Low Stock</a>
<table class="table table-sm table-hover table-striped mt-3">
    <thead>
        <tr>
            <th>#</th>
            <th>Model</th>
            <th>Type</th>
            <th>Current Stock</th>
            <th>Minimum Stock</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($tonerStocks as $stock)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $stock->model_name }}</td>
            <td>{{ $stock->toner_type->name }}</td>
            <td class="{{ $stock->computed_remaining_qty < $stock->minimum_quantity ? 'text-danger' : 'text-primary' }}">
                {{ $stock->computed_remaining_qty }}
            </td>
            <td>{{ $stock->minimum_quantity }}</td>
        </tr>
        @empty
            <tr>
                <td colspan="5"><center>No record found.</center></td>
            </tr>
        @endforelse
        
    </tbody>
</table>

@endsection
