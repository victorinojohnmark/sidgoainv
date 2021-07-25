@extends('layouts.app')

@section('content')
<a href="{{ route('checkins.show', $stock->check_in_id) }}" class="btn btn-primary mb-3">Check-in Reference No: {{ $stock->checkIn->ReferenceNo }}</a>
                
<div class="card">
    <div class="card-header">
        <strong>Stock ID #: </strong><span class="text-primary">{{ $stock->IDNo }}</span>&nbsp;<strong>Toner Model: </strong><span class="text-primary">{{ $stock->toner->model_name }}</span>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <h6><strong>Details</strong></h6>
                <table class="table table-bordered table-sm">
                    <tbody>
                        <tr>
                            <th>Check-in Stock</th>
                            <td>{{ $stock->quantity }} PCS</td>
                        </tr>
                        <tr>
                            <th>Total Release</th>
                            <td>{{ $stock->ReleaseItemCompleted->sum('quantity') }} PCS</td>
                        </tr>
                        <tr>
                            <th>Remaining Stock</th>
                            <td>{{ $stock->quantity - $stock->ReleaseItemCompleted->sum('quantity') }} PCS</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-9">
                <h6><strong>Distribution</strong></h6>
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>Check-out ID</th>
                            <th>Quantity</th>
                            <th>DR No.</th>
                            <th>Toner Code</th>
                            <th>Request Slip No.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stock->ReleaseItemCompleted as $releaseItem)
                        <tr>
                            <td><a href="{{ route('checkouts.show', $releaseItem->CheckOut->id) }}" class="text-primary">{{ $releaseItem->checkOut->ReferenceNo }}</a></td>
                            <td>{{ $releaseItem->quantity }}</td>
                            <td>{{ $releaseItem->checkOut->dr_no }}</td>
                            <td>{{ $releaseItem->checkOut->toner_code }}</td>
                            <td>{{ $releaseItem->checkOut->request_slip_no }}</td>
                        </tr>  
                        @empty
                            <tr>
                                <td colspan="5">No record found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
