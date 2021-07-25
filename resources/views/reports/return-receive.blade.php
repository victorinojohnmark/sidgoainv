@extends('layouts.report')

@section('content')

<h3 class="mb-3">Return Items</h3>


<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" href="/reports/returnReceive">Received</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/reports/returnReissue">Re-issue</a>
  </li>
</ul>
<div class="pt-3" id="recieved">
  
  <form action="/reports/returnReceive/search" method="POST" class="form-inline form-row">
    {{ Form::token() }}
    <div class="col-sm-2 my-1">
        <div class="form-group">
            <select name="search-type" id="" class="form-control w-100 searchType" required>
                <option disabled selected value>Search Type</option>
                <option value="reference_id">Reference ID</option>
                <option value="location">Location</option>
                <option value="date_received">Date received</option>
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
        <a href="/reports/returnReceive" class="btn btn-primary"><i class="fas fa-sync"></i> Refresh List</a>
  </div>
  </form>
  <strong class="pt-3">{{ $searchReceive ?? '' }}</strong>
  <table class="display nowrap datatables table table-striped table-hover table-bordered mt-3" 
  style="width:100%" 
  data-export-title="Return Received" 
  data-datetime="{{ date('YmdHis') }}" 
  data-orientation="landscape"
  data-searching="false">
      <thead>
          <tr>
              <th>Reference</th>
              <th>Location</th>
              <th>Toner Models</th>
              <th>Total Qty.</th>
              <th>Date Returned</th>
              <th>C.O Reference</th>
              <th>ROR</th>
              <th>SF</th>
              <th style="width:100px !important">Status</th>
          </tr>
      </thead>
      <tbody>
        {{-- {{ dd($returnReceives) }} --}}
        @forelse ($returnReceives as $returnReceive)
        <tr>
          <td>
            <a href="#"
            target="popup" 
            onclick="window.open('/reports/returnReceive/{{ $returnReceive->id }}','popup','width=600,height=900,menubar=no,toolbar=no,resizable=no,scrollbars=no'); return false;">
            {{ $returnReceive->reference_no }}
            </a>
          </td>
          <td>{{ $returnReceive->location->name ?? 'N/A'}}</td>
          <td>{{ count($returnReceive->TonerModels) ? implode(', ', $returnReceive->TonerModels) : 'N/A' }}</td>
          <td>{{ $returnReceive->returnItems->sum('quantity') }}</td>
          <td>{{ $returnReceive->date_received }}</td>
          <td>
            @if (count($returnReceive->CheckOutReferences))
                {{ implode(', ', $returnReceive->CheckOutReferences) }}
            @else
                {{ 'N/A' }}
            @endif
          </td>
          <td>{{ $returnReceive->reasonOfReturn->value }}</td>
          <td>{{ $returnReceive->subjectFor->value }}</td>
          <td>{{ $returnReceive->status ? 'Completed' : 'Pending' }}</td>
        </tr>
        @empty
        
        @endforelse
      </tbody>
      <tfoot>
        <tr>
          <th>Reference</th>
          <th>Location</th>
          <th>Toner Models</th>
          <th>Total Qty.</th>
          <th>Date Returned</th>
          <th>C.O Reference</th>
          <th>ROR</th>
          <th>SF</th>
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
