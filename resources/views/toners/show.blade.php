@extends('layouts.app')

@section('content')
<a href="{{ route('toners.index') }}" class="btn btn-primary mb-3"><i class="fas fa-caret-left"></i> Toner List</a>
                
<div class="card">
    <div class="card-header">
        <strong>Toner Model: </strong><span class="text-primary">{{ $toner->model_name }}</span>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <h6><strong>Details</strong></h6>
                <table class="table table-bordered table-sm">
                    <tbody>
                        <tr>
                            <th>Total Remaining Qty.</th>
                            <td>{{ $toner->CurrentStock }} Pc/s</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-9">
                <h6><strong>Stocks</strong></h6>
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>Check-in Reference # ID</th>
                            <th>Stock #</th>
                            <th>Quantity</th>
                            <th>Remaining</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($toner->stocks as $stock)
                            
                            @if ($stock->RemainingStock)
                                <tr>
                                    <td><a href="{{ route('checkins.show', $stock->checkIn->id) }}" target="_blank">{{ $stock->checkIn->ReferenceNo }}</a></td>
                                    <td><a href="{{ route('stocks.show', $stock->id) }}" target="_blank">{{ $stock->IDNo }}</a></td>
                                    <td>{{ $stock->quantity }}</td>
                                    <td>{{ $stock->RemainingStock }}</td>
                                </tr>
                            @endif
                            
                        @empty
                        <tr><td colspan="4">No results.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
