@extends('layouts.app')

@section('content')
<h1 class="display-6">{{ $page_title ?? 'Page Title'}}</h1>

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" href="{{ route('returnReceive.index') }}">Received</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('returnReissue.index') }}">Re-issue</a>
  </li>
</ul>
<div class="tab-pane pt-3" id="recieved">

  <a href="#" data-target="#modalReturnReceiveCreate" data-toggle="modal" class="btn btn-primary"><i class="fas fa-plus"></i> Create</a>
  @include('includes.modals.returnReceive.create')
  <a href="/returnReceive" class="btn btn-primary"><i class="fas fa-sync"></i> Refresh List</a>
  <form action="/returnReceive/search" method="POST" class="form-inline form-row">
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
    <div class="col-sm-1 my-3">
        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i></button>
  </div>
  </form>
  <strong class="pt-3">{{ $searchReceive ?? '' }}</strong>
  <table class="table table-sm table-stripe table-hover table-bordered mt-3">
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
              <th class="th-50">Status</th>
              <th>Processed By</th>
              <th>Updated By</th>
              <th>Option</th>
          </tr>
      </thead>
      <tbody>
        {{-- {{ dd($returnReceives) }} --}}
        @forelse ($returnReceives as $returnReceive)
        <tr>
          <td><a href="{{ route('returnReceive.show', $returnReceive->id ) }}">{{ $returnReceive->reference_no }}</a></td>
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
          <td><center><i class="fas fa-{{ $returnReceive->status ? 'check-circle text-success' : 'minus-circle text-danger' }}"></i></center></td>
          <td>{{ $returnReceive->ProcessedBy ?? 'N/A'}}</td>
          <td>{{ $returnReceive->UpdateBy ?? 'N/A'}}</td>
          <td>
            <a data-target="#modalUpdateReturnReceive{{ $returnReceive->id }}" data-toggle="modal" class="btn btn-sm btn-{{ $returnReceive->status ? 'secondary' : 'primary' }}"><i class="fas fa-edit"></i></a>
            @if (!$returnReceive->status) @include('includes.modals.returnReceive.update') @endif
            <a data-target="#modaDeleteReturnReceive{{ $returnReceive->id }}" data-toggle="modal" class="btn btn-sm {{ $returnReceive->status ? 'btn-secondary' : 'btn-danger' }}"><i class="fas fa-trash"></i></a>
            @if (!$returnReceive->status) @include('includes.modals.returnReceive.delete') @endif
          </td>
        </tr>
        @empty
            <tr>
              <td colspan="12">{{ 'No record/s found.' }}</td>
            </tr>
        @endforelse
      </tbody>
  </table>
  @if ( method_exists($returnReceives, 'links') )
      <div class="d-flex">
      {{ $returnReceives->links() }}
      </div>
  @endif
</div>

@endsection
