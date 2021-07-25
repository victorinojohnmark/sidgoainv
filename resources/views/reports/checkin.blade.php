@extends('layouts.report')

@section('content')

<h3 class="mb-3">Reports/Check-in</h3>
<form action="/reports/checkinSearch" method="post" id="searchCheckIn" class="form-inline form-row mb-3">
  @include('includes.forms.check-in-search')
</form>

<h5 class="mb-3">{{ $page_title ?? '' }}</h5>

<table class="display nowrap datatables table table-striped table-hover table-bordered" 
  style="width:100%" 
  data-export-title="Check-in" 
  data-datetime="{{ date('YmdHis') }}" 
  data-orientation="landscape"
  data-searching="false">
  <thead>
      <tr>
        <th style="width:20px !important"><center>#</center></th>
        <th style="width:180px !important;">Reference</th>
        <th>Batch Code</th>
        <th>Invoice</th>
        <th>OR</th>
        <th>QTY.</th>
        <th>Purchased Cost</th>
        <th>Purchased Date</th>
        <th>Supplier</th>
        <th style="width:100px !important">Status</th>
      </tr>
  </thead>
  <tbody>
    @forelse ($checkins as $checkin)
    <tr>
      <td><center>{{ $loop->index + 1 }}</center></td>
      <td>
          <a href="#" 
              target="popup" 
              onclick="window.open('/reports/checkins/{{ $checkin->id }}','popup','width=600,height=600,menubar=no,toolbar=no,resizable=no,scrollbars=no'); return false;">
            {{ $checkin->ReferenceNo }}
          </a>&nbsp;
          <input type="button" class="btn btn-sm btn-info text-white float-right" value="Released" 
              onclick="window.open('/reports/checkins/{{ $checkin->id }}/release','popup','width=600,height=600,menubar=no,toolbar=no,resizable=no,scrollbars=no'); return false;"></input>
      </td>
      <td>{{ $checkin->toner_code }}</td>
      <td>{{ $checkin->invoice_no }}</td>
      <td>{{ $checkin->or_no }}</td>
      <td>{{ $checkin->TotalQuantity }}</td>
      <td>&#8369; {{ number_format($checkin->purchased_cost, 2) }}</td>
      <td>{{ $checkin->return_reissue_id ? 'N/A' : $checkin->purchased_date }}</td>
      <td>
        {{-- {{ $checkin->return_reissue_id ? 'N/A' : $checkin->supplier->vendor_code }} --}}
        @if ($checkin->return_reissue_id) 
        <span class="badge badge-info text-white">Return Items: {{ $checkin->returnReissue->reference_no }}</span> 
        @else
        {{ $checkin->supplier->vendor_code }}
        @endif
      </td>
      <td>
          @if ($checkin->status)
              Completed
          @else
              Pending
          @endif
      </td>
    </tr>
    @empty
        
    @endforelse
  </tbody>
  <tfoot>
    <tr>
      <th style="width:20px !important"><center>#</center></th>
      <th>Reference</th>
      <th>Batch Code</th>
      <th>Invoice</th>
      <th>OR</th>
      <th>QTY.</th>
      <th>Purchased Cost</th>
      <th>Purchased Date</th>
      <th>Supplier</th>
      <th style="width:100px !important">Status</th>
    </tr>
  </tfoot>
</table>
<div class="alert alert-secondary mt-3 p-2 d-inline-block" role="alert">
  <i class="fas fa-info-circle"></i>&nbsp; Record(s) as of {{ date('Y-m-d H:i:s') }}
</div>
</div>


    


@endsection
