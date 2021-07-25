@extends('layouts.app')

@section('content')
<a href="{{ route('returnReceive.index') }}" class="btn btn-primary">Return List</a>
<hr>
<h1 class="display-6">{{ $page_title ?? 'Page Title'}}</h1>
<div class="row">
    <div class="col-md-6">
        <table class="table table-sm table-stripe table-bordered mt-3">
            <tbody>
                <tr>
                    <th>Location</th>
                    <td>{{ $returnReissue->returnReceive->location->name }}</td>
                </tr>
                <tr>
                    <th>Toner Models</th>
                    <td>{{ count($returnReissue->returnReceive->TonerModels) ? implode(', ', $returnReissue->returnReceive->TonerModels) : 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Quantity</th>
                    <td>{{ $returnReissue->returnReceive->returnItems->sum('quantity') }}</td>
                </tr>
                <tr>
                    <th>Return Reference</th>
                    <td>{{ $returnReissue->returnReceive->reference_no }}</td>
                </tr>
                <tr>
                    <th>Checkout reference</th>
                    <td>{{ count($returnReissue->returnReceive->CheckOutReferences) ? implode(', ', $returnReissue->returnReceive->CheckOutReferences) : 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Reason of returns</th>
                    <td>{{ $returnReissue->returnReceive->reasonOfReturn->value }}</td>
                </tr>
                <tr>
                    <th>Subject For</th>
                    <td>{{ $returnReissue->returnReceive->subjectFor->value }}</td>
                </tr>
                <tr>
                    <th>Date Returned</th>
                    <td>{{ $returnReissue->returnReceive->date_received }}</td>
                </tr>
                <tr>
                    <th>Delivery Date</th>
                    <td>{{ $returnReissue->delivery_date ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $returnReissue->status ? 'Completed' : 'Pending' }}</td>
                </tr>
                <tr>
                    <th>Re-issue Type</th>
                    <td>{{ $returnReissue->reissueType->name }}</td>
                </tr>
            </tbody>
        </table>
        @if (!$returnReissue->status)
            {{ Form::open(['url' => '/returnReissue/setCompleted/'.$returnReissue->id, 'method' => 'PATCH']) }}
                {{ Form::token() }}
                @if ($returnReissue->reissue_type_id == 2)
                    <div class="alert alert-info" role="alert">
                        <p class="mb-0"><i class="fas fa-info-circle"></i> Please be reminded: <strong>Return to stock</strong> re-issues will create checkin after confirming automatically. No option to revert back.</p>
                    </div>
                @endif
                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Confirm Re-issue</button>
            {{ Form::close() }}
        @endif
    </div>
</div>


@endsection
