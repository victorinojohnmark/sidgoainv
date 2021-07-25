@extends('layouts.report')

@section('content')

<h3 class="mb-3">Reports/Check-out</h3>
<form action="/reports/checkoutSearch" method="post" id="searchCheckout" class="form-inline form-row mb-3">
  @include('includes.forms.check-out-search')
</form>

<h5 class="mb-3">{{ $page_title ?? '' }}</h5>

<table class="display nowrap datatables table table-striped table-hover table-bordered" 
  style="width:100%" 
  data-export-title="Check-out" 
  data-datetime="{{ date('YmdHis') }}" 
  data-orientation="landscape"
  data-searching="false">
  <thead>
    <tr>
      <th style="width:20px !important"><center>#</center></th>
      <th>Reference</th>
      <th>Items</th>
      <th>Location</th>
      <th>DR</th>
      <th>Sales Invoice</th>
      <th>PO</th>
      <th>Batch Code</th>
      <th>Req. Slip</th>
      <th>Delivery Date</th>
      <th>Delivery Status</th>
      <th style="width:100px !important">Status</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($checkouts as $checkout)
      <tr>
        <td><center>{{ $loop->index + 1}}</center></td>
        <td>
          <a href="#"  target="popup" 
              onclick="window.open('/reports/checkouts/{{ $checkout->id }}','popup','width=600,height=900,menubar=no,toolbar=no,resizable=no,scrollbars=no'); return false;">
            {{ $checkout->ReferenceNo }}
          </a>
        </td>
        <td><p>{{ count($checkout->releaseItems) ? implode(', ', $checkout->ItemSpecifics) : 'N/A' }}</p></td>
        <td>{{ $checkout->location->location_code }}</td>
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
        <td>{{ $checkout->DeliveryStatus }}</td>
        <td>{{ $checkout->void_status ? 'Void' : ($checkout->status ? 'Completed' : 'Pending') }}</td>
      </tr>
    @empty

    @endforelse
  </tbody>
  <tfoot>
    <tr>
      <th style="width:20px !important"><center>#</center></th>
      <th>Reference</th>
      <th>Items</th>
      <th>Location</th>
      <th>DR</th>
      <th>Sales Invoice</th>
      <th>PO</th>
      <th>Toner Code</th>
      <th>Req. Slip</th>
      <th>Delivery Date</th>
      <th>Delivery Status</th>
      <th style="width:100px !important">Status</th>
    </tr>
  </tfoot>
</table>
<div class="alert alert-secondary mt-3 p-2 d-inline-block" role="alert">
  <i class="fas fa-info-circle"></i>&nbsp; Record(s) as of {{ date('Y-m-d H:i:s') }}
</div>
</div>
@endsection
