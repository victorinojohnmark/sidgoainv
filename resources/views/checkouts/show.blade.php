@extends('layouts.app')

@section('content')
<a href="{{ route('checkouts.index') }}" class="btn btn-primary mb-3"><i class="fas fa-caret-left"></i> Check-out list</a>
                
<div class="card">
    <div class="card-header">
        <strong>Reference #:</strong> <span class="text-primary">{{ $checkout->reference_no }}</span>
    </div>
    <div class="card-body">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-6">
                    <h6><strong>Details</strong></h6>
                    <table class="table table-sm table-bordered">
                        <tbody>
                            <tr>
                                <th>Location</th>
                                <td>{{ $checkout->location->location_code }}</td>
                            </tr>
                            <tr>
                                <th>DR No.</th>
                                <td>{{ $checkout->delivery->dr_no ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Sales Invoice</th>
                                <td>{{ $checkout->invoice_no ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Batch Code</th>
                                <td>
                                    @if (count($checkout->TonerCodes))
                                    {{ implode(', ', $checkout->TonerCodes) }}
                                    @else
                                    {{ 'N/A' }}  
                                    @endif 
                                </td>
                            </tr>
                            <tr>
                                <th>Request Slip No.</th>
                                <td>{{ $checkout->request_slip_no }}</td>
                            </tr>
                            <tr>
                                <th>Delivery Date</th>
                                <td>{{ $checkout->delivery_date ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Delivery Status</th>
                                <td>{{ $checkout->DeliveryStatus }}</td>
                            </tr>
                            @if (!is_null($checkout->parentCheckout))
                                <th>Main Checkout</th>
                                <td><a href="{{ route('checkouts.show', $checkout->parent_checkout_id) }}" target="_blank">{{ $checkout->parentCheckout->reference_no }}</a></td>
                            @endif
                            @if (!is_null($checkout->completingCheckout))
                            <th>Completing Checkout</th>
                            <td><a href="{{ route('checkouts.show', $checkout->completingCheckout->id) }}" target="_blank">{{ $checkout->completingCheckout->reference_no }}</a></td>
                            @endif
                        </tbody>
                    </table>
                    <p><strong>Note: </strong></br>{{ $checkout->note ?? 'n/a' }}</p>
                </div>

                <div class="col-md-6">
                    <h6><strong>Total</strong></h6>
                    
                    <table class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Toner</th>
                                <th>Type</th>
                                <th>Total QTY.</th>
                                <th>Units</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($totalReleases->sortBy('id') as $totalRelease)
                            <tr>
                                <td>{{ $totalRelease->stock->toner->model_name }}</td>
                                <td>{{ $totalRelease->stock->toner->toner_type->name }}</td>
                                <td>{{ $totalRelease->total_count }}</td>
                                <td>{{ $totalRelease->stock->toner->unit->name }}</td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No record found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    
                        @can('checkout-complete')
                            @if ($checkout->status == 0 && $checkout->void_status == 0)
                                <a href="#" data-toggle="modal" data-target="#modalconfirmCompleted" class="btn btn-success"><i class="fas fa-check"></i> Set as completed</a>
                                @include('includes.modals.checkout.confirm-complete')
                            @endif
                        @endcan

                        @can('checkout-void')
                            @if ($checkout->status == 0 && $checkout->void_status == 0)
                                <a href="#" data-toggle="modal" data-target="#modalConfirmVoidCheckout" class="btn btn-danger"><i class="fas fa-ban"></i> Void</a>
                                {{-- {{ Form::open(['url' => '/checkouts/void/'.$checkout->id, 'method' => 'PATCH']) }}
                                    {{ Form::token() }}
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-ban"></i> Void</button>
                                {{ Form::close() }} --}}
                                @include('includes.modals.checkout.confirm-void')
                            @endif
                        @endcan

                        @if (is_null($checkout->completingCheckout) && $checkout->status == 1 && $checkout->delivery_status_id == 2)
                            <a href="#" data-toggle="modal" data-target="#modalAddCompletionCheckOut" class="btn btn-success">Create completion checkout</a>
                            @include('includes.modals.checkout.completion-checkout')
                        @endif
                        
                        {{-- {{ dd(is_null($checkoust->completingCheckout)) }} --}}
                    
                </div>

                <div class="col-md-12">
                    <hr>
                </div>
                
                <div class="col-md-12">
                    <h6><strong>Item Summary</strong></h6>
                    @can('releaseitem-create')
                        @if ($checkout->status == 0 && $checkout->void_status == 0)
                            <a href="#" data-toggle="modal" data-target="#modalAddReleaseItem" class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus"></i> Add Item</a>
                            @include('includes.modals.releaseitem.add')
                        @endif
                    @endcan
                    

                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>Check-in Reference ID</th>
                                <th>Stock ID #</th>
                                <th>Toner Model</th>
                                <th>Quantity</th>
                                <th>Note</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($checkout->releaseItems->sortBy('id') as $releaseItem)
                            <tr>
                                <td><a href="{{ route('checkins.show', $releaseItem->stock->checkIn->id) }}" class="text-primary">{{ $releaseItem->stock->checkIn->ReferenceNo }}</a></td>
                                <td><a href="{{ route('stocks.show', $releaseItem->stock->id) }}" target="_blank">{{ $releaseItem->stock->IDNo }}</a></td>
                                <td>{{ $releaseItem->stock->toner->model_name }}</td>
                                <td>{{ $releaseItem->quantity }}</td>
                                <td>{{ $releaseItem->note ?? 'n/a'}}</td>
                                <td>
                                    @if (!$releaseItem->checkOut->status && $checkout->void_status == 0)
                                        @can('releaseitem-edit')
                                            <a href="#" data-toggle="modal" data-target="#updateModalReleaseItem{{ $releaseItem->id }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                            @include('includes.modals.releaseitem.update')
                                        @else
                                            <a class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>
                                        @endcan
                                        @can('releaseitem-delete')
                                            <a href="#" data-toggle="modal" data-target="#deleteModalReleaseItem{{ $releaseItem->id }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                            @include('includes.modals.releaseitem.delete')
                                        @endcan
                                    @else
                                        <button class="btn btn-sm btn-secondary">N/A</button>
                                    @endif
                                    
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">No record found.</td>
                            </tr> 
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


