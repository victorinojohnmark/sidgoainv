@extends('layouts.report')

@section('content')

<h3 class="mb-3">Return Items</h3>


<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" href="/reports/returnReceive">Received</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="/reports/returnReissue">Re-issue</a>
  </li>
</ul>

<div class="pt-3" id="reissue">
  <form action="/reports/returnReissue/search" method="POST" class="form-inline form-row">
    {{ Form::token() }}
    <div class="col-sm-2 my-1">
        <div class="form-group">
            <select name="search-type" id="" class="form-control w-100 searchType" required>
                <option disabled selected value>Search Type</option>
                <option value="reference_id">Reference ID</option>
                <option value="location">Location</option>
                <option value="date">Date created</option>
            </select>
        </div>
    </div>
    <div class="col-sm-3 my-1 w-100 d-none" id="searchInput">
        <input type="text" name="search" class="form-control w-100" placeholder="Search here...">
    </div>
    <div class="col-sm-3 d-none" id="locationSelect">
        {{ Form::select('location_id', $locations, old('location_id'), ['placeholder' => 'Select here...', 'class' => 'form-control w-100']) }}
    </div>
    <div class="col-sm-2 my-1 form-inline date-range d-none" id="startDate">
        <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">From</span>
            </div>
            <input type="date" name="date-start" class="form-control">
        </div>
    </div>
    <div class="col-sm-2 my-1 form-inline date-range d-none" id="endDate">
        <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">To</span>
            </div>
            <input type="date" name="date-end" class="form-control">
        </div>
    </div>
    <div class="col-sm-2 my-3">
      <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
      <a href="/reports/returnReissue" class="btn btn-primary"><i class="fas fa-sync"></i> Refresh List</a>
  </div>
  </form>
  <strong class="mt-3">{{ $searchReissue ?? '' }}</strong>
  <table class="display nowrap datatables table table-striped table-hover table-bordered mt-3" 
  style="width:100%" 
  data-export-title="Return Reissue" 
  data-datetime="{{ date('YmdHis') }}" 
  data-orientation="landscape"
  data-searching="false">
    <thead>
      <tr>
        <th>Reference</th>
        <th>Location</th>
        <th>Toner Models</th>
        <th>Quantity</th>
        <th>Reissue Type</th>
        <th>Return Reference</th>
        <th>ROR</th>
        <th>Checkout Reference</th>
        <th>Date Returned</th>
        <th>DR</th>
        <th>Delivery Date</th>
        <th style="width:100px !important">Status</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($returnReissues as $returnReissue)
        <tr>
          <td>
            <a href="#"target="popup" 
            onclick="window.open('/reports/returnReissue/{{ $returnReissue->id }}','popup','width=600,height=900,menubar=no,toolbar=no,resizable=no,scrollbars=no'); return false;">
            {{ $returnReissue->reference_no }}
            </a>
          </td>
          <td>{{ $returnReissue->returnReceive->location->name }}</td>
          <td>{{ count($returnReissue->returnReceive->TonerModels) ? implode(', ', $returnReissue->returnReceive->TonerModels) : 'N/A' }}</td>
          <td>{{ $returnReissue->returnReceive->returnItems->sum('quantity') }}</td>
          <td>{{ $returnReissue->reissueType->name }}</td>
          <td>{{ $returnReissue->returnReceive->reference_no }}</td>
          <td>{{ $returnReissue->returnReceive->reasonOfReturn->value }}</td>
          <td>{{ count($returnReissue->returnReceive->CheckOutReferences) ? implode(', ', $returnReissue->returnReceive->CheckOutReferences) : 'N/A' }}</td>
          <td>{{ $returnReissue->returnReceive->date_received }}</td>
          <td>{{ $returnReissue->reissue_type_id <> 2 ? $returnReissue->dr_no ?? 'N/A' : 'N/A' }}</td>
          <td>{{ $returnReissue->delivery_date ?? 'N/A' }}</td>
          <td>{{ $returnReissue->status ? 'Completed' : 'Pending' }}</td>
        </tr>
      @empty
        
      @endforelse
    </tbody>
    <tfoot>
      <tr>
        <th>Reference</th>
        <th>Location</th>
        <th>Toner Models</th>
        <th>Quantity</th>
        <th>Reissue Type</th>
        <th>Return Reference</th>
        <th>ROR</th>
        <th>Checkout Reference</th>
        <th>Date Returned</th>
        <th>DR</th>
        <th>Delivery Date</th>
        <th style="width:100px !important">Status</th>
      </tr>
    </tfoot>
  </table>
</div>

<div class="alert alert-secondary mt-3 p-2 d-inline-block" role="alert">
  <i class="fas fa-info-circle"></i>&nbsp; Record(s) as of {{ date('Y-m-d H:i:s') }}
</div>
</div>


    


@endsection

