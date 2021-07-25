@extends('layouts.app')

@section('content')
<h1 class="display-6">{{ $page_title }}</h1>
<a href="#" data-target="#modalOffTheRecordCreate" data-toggle="modal" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Add</a>
@include('includes.modals.offTheRecord.create')

<table class="table table-sm table-stripe table-bordered table-hover">
  <thead>
    <tr>
      <th>Reference No</th>
      <th>Type</th>
      <th>Trans.Date</th>
      <th>Trans. Ref. </th>
      <th>Location</th>
      <th>Quantity</th>
      <th>Issue Description</th>
      <th>Subject For</th>
      <th>Action Taken</th>
      <th>Action Reference</th>
      <th>Date</th>
      <th>Processed By</th>

    </tr>
  </thead>
  <tbody>
    @forelse ($offTheRecords as $record)
    <tr>
      <td data-toggle="tooltip" data-placement="bottom" title="Note: {{ $record->note ?? 'n/a' }}"><a href="{{ route('offTheRecord.show', $record->id) }}">{{ $record->reference_no }}</a></td>
      <td>{{ $record->offTheRecordTransactionType->value }}</td>
      <td>{{ $record->transaction_date }}</td>
      <td>{{ $record->transaction_reference }}</td>
      <td>{{ $record->location->name }}</td>
      <td>{{ $record->TotalQuantity }}</td>
      <td>{{ $record->offTheRecordIssueDescription->value }}</td>
      <td>{{ $record->offTheRecordSubjectFor->value }}</td>
      <td>{{ $record->offTheRecordActionTaken->value }}</td>
      <td>{{ $record->action_reference ?? 'N/A' }}</td>
      <td>{{ $record->created_at->toDateString() }}</td>
      <td>{{ $record->CreatedByUsername }}</td>
    </tr>
    @empty
        <tr>
          <td colspan="12">No record/s found</td>
        </tr>
    @endforelse
  </tbody>
</table>


@endsection