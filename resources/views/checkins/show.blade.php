@extends('layouts.app')

@section('content')
<a href="{{ route('checkins.index') }}" class="btn btn-primary mb-3">Check-in List</a>

<div class="card">
    <div class="card-header">
        <strong>Reference #: </strong> <span class="text-primary">{{ $checkin->ReferenceNo }}</span>
    </div>
    <div class="card-body">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-6">
                    <h6><strong>Details</strong></h6>
                    <table class="table table-sm table-bordered">
                        <tbody>
                            <tr>
                                <th>Batch Code</th>
                                <td>{{ $checkin->toner_code }}</td>
                            </tr>
                            <tr>
                                <th>Invoice No.</th>
                                <td>{{ $checkin->invoice_no }}</td>
                            </tr>
                            <tr>
                                <th>OR No.</th>
                                <td>{{ $checkin->or_no }}</td>
                            </tr>
                            <tr>
                                <th>QTY</th>
                                <td>{{ $checkin->TotalQuantity }}</td>
                            </tr>
                            <tr>
                                <th>Purchased Cost</th>
                                <td>&#8369; {{ number_format($checkin->purchased_cost, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Purchased Date</th>
                                <td>{{ $checkin->return_reissue_id ? 'N/A' : $checkin->purchased_date }}</td>
                            </tr>
                            <tr>
                                <th>Supplier</th>
                                <td>
                                    {{-- {{ $checkin->return_reissue_id ? 'N/A' : $checkin->supplier->name }} --}}
                                    @if ($checkin->return_reissue_id) 
                                    <span class="badge badge-info text-white">Return Items: {{ $checkin->returnReissue->reference_no }}</span> 
                                    @else
                                    {{ $checkin->supplier->vendor_code }}
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p><strong>Note: </strong></br>{{ $checkin->note ?? 'n/a' }}</p>
                </div>

                <div class="col-md-6">
                    <h6><strong>Item Summary</strong></h6>
                    @if (!$checkin->status)
                        @can('stock-create')
                            <a href="#" data-toggle="modal" data-target="#modalAddStock" class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus"></i> Add Item</a>
                            @include('includes.modals.stock.add')
                        @endcan
                    @endif

                    <table class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Toner</th>
                                <th>Type</th>
                                <th>QTY.</th>
                                <th>Units</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($checkin->stocks as $stock)
                                <tr>
                                    <td>{{ $stock->IDNo }}</td>
                                    <td>
                                        <a href="#" data-target="#modalShowStock{{ $stock->id }}" data-toggle="modal" class="text-primary">{{ $stock->toner->model_name }}</a>
                                        @include('includes.modals.stock.show')
                                    </td>
                                    <td>{{ $stock->toner->toner_type->name }}</td>
                                    <td>{{ $stock->quantity }}</td>
                                    <td>{{ $stock->toner->unit->name }}</td>
                                    <td>
                                        @if (!$stock->checkIn->status)
                                        @can('stock-edit')
                                            <a href="#" data-toggle="modal" data-target="#modalUpdateStock{{ $stock->id }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                            @include('includes.modals.stock.update')
                                        @endcan
                                        
                                        @can('stock-delete')
                                            <a href="#" data-toggle="modal" data-target="#modalDeleteStock{{ $stock->id }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                            @include('includes.modals.stock.delete')
                                            @endcan
                                        @else
                                            <button class="btn btn-sm btn-secondary">N/A</button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"><center>No record/s.</center></td>
                                </tr>
                            @endforelse
                           
                        </tbody>
                    </table>
                    @if ($checkin->status == 0)
                        @can('checkin-complete')
                            <a href="#" data-toggle="modal" data-target="#modalconfirmCompleted" class="btn btn-success"><i class="fas fa-check"></i> Set as completed</a>
                            @include('includes.modals.checkin.confirm-complete')
                        @endcan
                    @endif

                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
