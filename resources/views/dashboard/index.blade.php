@extends('layouts.app')

@section('content')

<h1 class="display-6 mb-3">Item Count</h1>
<a href="/dashboard" class="btn btn-sm btn-info text-white">On Stock</a> 
<a href="/dashboard/lowstock" class="btn btn-sm btn-danger">Low Stock</a>
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
        @forelse ($tonerStocks as $toner)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td><a href="{{ route('toners.show', $toner->id) }}">{{ $toner->model_name }}</a></td>
            <td>{{ $toner->toner_type->name }}</td>
            <td class="{{ $toner->computed_remaining_qty < $toner->minimum_quantity ? 'text-danger' : 'text-primary' }}">
                {{ $toner->computed_remaining_qty }}
            </td>
            <td>{{ $toner->minimum_quantity }}</td>
        </tr>
        @empty
            <tr>
                <td colspan="5"><center>No record found.</center></td>
            </tr>
        @endforelse
        
    </tbody>
</table>

@endsection
