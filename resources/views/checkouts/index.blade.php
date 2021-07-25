@extends('layouts.app')

@section('content')

@can('checkout-create')
    <h1 class="display-6">{{ $page_title ?? 'Page Title'}}</h1>
    <a href="#" data-target="#modalAddCheckOut" data-toggle="modal" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Create</a>
    <a href="{{ route('checkouts.index') }}" class="btn btn-primary mb-3"><i class="fas fa-sync"></i> Refresh List</a>
    @include('includes.modals.checkout.add')
@else
    <a class="btn btn-sm btn-secondary"><i class="fas fa-plus"></i> Create</a>
@endcan

<form action="/checkouts/search" method="POST" id="searchCheckIn" class="form-inline form-row mb-3">
@include('includes.forms.check-out-search')
</form>

<table class="table table-sm table-hover table-striped table-bordered">
    <thead>
        <tr>
            <th>Reference</th>
            <th>Location</th>
            <th>DR</th>
            <th>Sales Invoice</th>
            <th>PO</th>
            <th style="width:15%;">Batch Code</th>
            <th>Req. Slip</th>
            <th>Delivery Date</th>
            <th>Delivery Status</th>
            <th class="th-50">Status</th>
            <th>Processed By</th>
            <th>Updated By</th>
            <th style="width:120px;">Option</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($checkouts as $checkout)
        <tr>
            <td data-toggle="tooltip" data-placement="bottom" title="Note: {{ $checkout->note ?? 'n/a' }}">
                <a href="{{ route('checkouts.show', $checkout->id) }}" >{{ $checkout->reference_no }}</a> 
                
            </td>
            <td>
                {{ $checkout->location->location_code }}
                @if ($checkout->return_to_supplier)
                <span class="badge badge-info text-white">Return to supplier</span>
                @endif
            </td>
            <td>{{ $checkout->delivery->dr_no ?? 'N/A' }}</td>
            <td>{{ $checkout->invoice_no ?? 'N/A' }}</td>
            <td>{{ $checkout->po_no }}</td>
            <td>
                @if (count($checkout->TonerCodes))
                {{ implode(', ', $checkout->TonerCodes) }}
                @else
                {{ 'N/A' }}  
                @endif
            </td>
            <td>{{ $checkout->request_slip_no }}</td>
            <td>{{ $checkout->delivery_date ?? 'N/A' }}</td>
            <td>
                {{ $checkout->DeliveryStatus }}
                @if (!is_null($checkout->completingCheckout))
                <br><span class="badge badge-info text-white">Completion Checkout: {{ $checkout->completingCheckout->reference_no }}</span>
                @endif
            </td>
            <td>
                <center>
                    @if ($checkout->void_status) 
                        <span class="badge badge-danger text-white d-inline">VOID</span> 
                    @else
                        @if ($checkout->status)
                        <i class="fas fa-check-circle text-success"></i>
                        @else
                            <i class="fas fa-minus-circle text-danger"></i>
                        @endif
                    @endif
                    
                </center> 
            </td>
            <td>{{ $checkout->CreatedByUsername ?? 'n/a' }}</td>
            <td>{{ $checkout->EditedByUsername ?? 'n/a' }}</td>
            <td>
            @if ($checkout->status)
                <a href="#" data-target="#modalUploadFileCheckout{{ $checkout->id }}" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fas fa-file"></i></a>
                @include('includes.modals.checkout.upload')
            @else
                <a class="btn btn-sm btn-secondary"><i class="fas fa-file"></i></a>
            @endif

            @if (!$checkout->void_status)
                @can('checkout-edit')
                    <a href="#" data-target="#modalUpdateCheckout{{ $checkout->id }}" data-toggle="modal" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                    @include('includes.modals.checkout.update')
                @else
                    <a class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>
                @endcan
            @endif

            {{-- @if (!$checkout->status)
                @can('checkout-delete')
                    <a href="#" data-target="#modalDeleteCheckout{{ $checkout->id }}" data-toggle="modal" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                    @include('includes.modals.checkout.delete')
                @else
                    <a class="btn btn-sm btn-secondary"><i class="fas fa-trash"></i></a>
                @endcan
            @else
                <a class="btn btn-sm btn-secondary"><i class="fas fa-trash"></i></a>
            @endif --}}
            
            </td>
            
        </tr>
        @empty
            <tr>
                <td colspan="12"><center>No record found</center></td>
            </tr>
        @endforelse
    </tbody>
</table>

 
@if ( method_exists($checkouts, 'links') )
    <div class="d-flex">
    {{ $checkouts->links() }}
    </div>
@endif



@endsection
