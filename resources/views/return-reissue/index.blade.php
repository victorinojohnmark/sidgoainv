@extends('layouts.app')

@section('content')
<h1 class="display-6">{{ $page_title ?? 'Page Title'}}</h1>

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" href="{{ route('returnReceive.index') }}">Received</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="{{ route('returnReissue.index') }}">Re-issue</a>
  </li>
</ul>

<div class="tab-pane pt-3" id="reissue">
  <a href="/returnReissue" class="btn btn-primary"><i class="fas fa-sync"></i> Refresh List</a>
  <form action="/returnReissue/search" method="POST" class="form-inline form-row">
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
    <div class="col-sm-1 my-3">
        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i></button>
  </div>
  </form>
  <strong class="mt-3">{{ $searchReissue ?? '' }}</strong>
  <table class="table table-sm table-stripe table-bordered table-hover mt-3">
    <thead>
      <tr>
        <th>Reference</th>
        <th>Location</th>
        <th>Toner Models</th>
        <th>Quantity</th>
        <th>Reissue Type</th>
        <th>Return Reference</th>
        <th>ROR</th>
        <th>Date Returned</th>
        <th>DR</th>
        <th>Delivery Date</th>
        <th class="th-50">Status</th>
        <th>Processed By</th>
        <th>Updated By</th>
        <th>Option</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($returnReissues as $returnReissue)
        <tr>
          <td><a href="{{ route('returnReissue.show', $returnReissue->id) }}">{{ $returnReissue->reference_no }}</a></td>
          <td>{{ $returnReissue->returnReceive->location->name }}</td>
          <td>{{ count($returnReissue->returnReceive->TonerModels) ? implode(', ', $returnReissue->returnReceive->TonerModels) : 'N/A' }}</td>
          <td>{{ $returnReissue->returnReceive->returnItems->sum('quantity') }}</td>
          <td>{{ $returnReissue->reissueType->name }}</td>
          <td><a href="{{ route('returnReceive.show', $returnReissue->return_receive_id) }}" target="blank">{{ $returnReissue->returnReceive->reference_no }}</a></td>
          <td>{{ $returnReissue->returnReceive->reasonOfReturn->value }}</td>
          <td>{{ $returnReissue->returnReceive->date_received }}</td>
          <td>{{ $returnReissue->dr_no ?? 'N/A' }}</td>
          <td>{{ $returnReissue->delivery_date ?? 'N/A' }}</td>
          <td><center><i class="fas fa-{{ $returnReissue->status ? 'check-circle text-success' : 'minus-circle text-danger' }}"></i></center></td>
          <td>{{ $returnReissue->ProcessedBy ?? 'N/A'}}</td>
          <td>{{ $returnReissue->UpdatedBy ?? 'N/A'}}</td>
          <td>
            <a data-toggle="modal" data-target="#modalDeleteReturnReissue{{ $returnReissue->id }}" class="btn btn-sm btn-{{ $returnReissue->status ? 'secondary' : 'danger' }}"><i class="fas fa-trash"></i></a>
            @include('includes.modals.returnReissue.delete')
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="12">No record/s to view.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

@endsection
