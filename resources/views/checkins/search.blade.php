@extends('layouts.app')

@section('content')
<h1 class="display-6">{{ $page_title ?? 'Page Title'}}</h1>
{{-- <a href="#" data-target="#modalAddCheckIn" data-toggle="modal" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Create</a>
@include('includes.modals.checkin.add') --}}

<form action="/checkins/search" method="post" id="searchCheckIn" class="form-inline form-row mb-3">
@include('includes.forms.check-in-search')
</form>

<table class="table table-sm table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Reference #</th>
            <th>Toner Code</th>
            <th>Invoice #</th>
            <th>OR #</th>
            <th>QTY.</th>
            <th>Purchased Date</th>
            <th>Purchased Cost</th>
            <th>Supplier</th>
            <th class="th-50">Status</th>
            <th>Created By</th>
            <th>Edited By</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($checkins as $checkin)
        <tr>
            <td data-toggle="tooltip" data-placement="bottom" title="Note: {{ $checkin->note ?? 'n/a' }}">
                <a href="{{ route('checkins.show', $checkin->id) }}">{{ $checkin->ReferenceNo }}</a>
            </td>
            <td>{{ $checkin->toner_code }}</td>
            <td>{{ $checkin->invoice_no }}</td>
            <td>{{ $checkin->or_no }}</td>
            <td>{{ $checkin->TotalQuantity }}</td>
            <td>&#8369; {{ number_format($checkin->purchased_cost, 2) }}</td>
            <td>{{ $checkin->purchased_date }}</td>
            <td>{{ $checkin->supplier->vendor_code }}</td>
            <td>
                @if ($checkin->status)
                <center><i class="fas fa-check-circle text-success"></i></center>
                @else
                    <center><i class="fas fa-minus-circle text-danger"></i></center>
                @endif
            </td>
            <td>{{ $checkin->CreatedByUsername ?? 'n/a'}}</td>
            <td>{{ $checkin->EditedByUsername ?? 'n/a' }}</td>
            <td>
                <center>
                    @can('checkin-edit')
                        <a href="#" data-target="#modalUpdateCheckin" data-toggle="modal" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                        @include('includes.modals.checkin.update')
                    @else
                        <a class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>
                    @endcan
                </center>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="12"><center>No record found</center></td>
        </tr>
            
        @endforelse
    </tbody>
</table>

{{-- <a href="#" class="btn btn-sm btn-danger">Print PDF</a> --}}


@endsection
