@extends('layouts.app')

@section('content')
<h1 class="display-6">{{ $page_title ?? 'Page Title'}}</h1>

<form action="/checkouts/search" method="POST" id="searchCheckIn" class="form-inline form-row mb-3">
@include('includes.forms.check-out-search')
</form>

<table class="table table-sm table-hover table-striped table-bordered">
    <thead>
        <tr>
            <th>Reference #</th>
            <th>Location</th>
            <th>DR No.</th>
            <th>Sales Invoice</th>
            <th>Toner Code</th>
            <th>Req. Slip No.</th>
            <th>Delivery Date</th>
            <th>Delivery Status</th>
            <th class="th-50">Status</th>
            <th>Created By</th>
            <th>Updated By</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($checkouts as $checkout)
        <tr>
            <td data-toggle="tooltip" data-placement="bottom" title="Note: {{ $checkout->note ?? 'n/a' }}">
                <a href="{{ route('checkouts.show', $checkout->id) }}" >
                {{ $checkout->ReferenceNo }}
                </a>
            </td>
            <td>{{ $checkout->location->location_code }}</td>
            <td>{{ $checkout->dr_no }}</td>
            <td>{{ $checkout->invoice_no }}</td>
            <td>
                @forelse ($checkout->TonerCodes as $tonerCode)
                    @if ($loop->index)
                        {{ ', ' . $tonerCode }}
                    @else
                        {{ $tonerCode }}
                    @endif
                @empty
                    {{ 'N/A' }}
                @endforelse
            </td>
            <td>{{ $checkout->request_slip_no }}</td>
            <td>{{ $checkout->delivery_date }}</td>
            <td>{{ $checkout->DeliveryStatus }}</td>
            <td>
                <center>
                    @if ($checkout->status)
                    <i class="fas fa-check-circle text-success"></i>
                    @else
                    <i class="fas fa-minus-circle text-danger"></i>
                    @endif
                </center> 
            </td>
            <td>{{ $checkout->CreatedByUsername ?? 'n/a' }}</td>
            <td>{{ $checkout->EditedByUsername ?? 'n/a' }}</td>
            <td>
            @can('checkout-edit')
                <a href="#" data-target="#modalUpdateCheckout" data-toggle="modal" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                @include('includes.modals.checkout.update')
            @else
                <a class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>
            @endcan
            </td>
            
        </tr>
        @empty
            <tr>
                <td colspan="12"><center>No record found</center></td>
            </tr>
        @endforelse
    </tbody>
</table>


@endsection
