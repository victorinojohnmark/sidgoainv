@extends('layouts.app')

@section('content')
<a href="{{ route('returnReceive.index') }}" class="btn btn-primary">Return List</a>
<hr>
<h1 class="display-6">{{ $page_title ?? 'Page Title'}}</h1>
<div class="row">
    @if (!$returnReceive->status)
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                {{-- <h5>Check-out List</h5> --}}
                {{-- <form action="/returnReceive/search-checkout/{{ $returnReceive->id }}" method="POST" class="form-inline"> --}}
                <form action="/returnReceive/{{ $returnReceive->id }}" method="GET" class="form-inline">
                    {{-- {{ Form::token() }} --}}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button class="btn btn-primary" type="submit" id="button-search"><i class="fas fa-search"></i></button>
                        </div>
                        <input type="text" name="checkout-search" class="form-control" placeholder="Search checkout here...">
                    </div>
                </form>
                <table class="table table-sm table-hover table-stripe table-bordered mt-3">
                    <thead>
                        <tr>
                            <th class="px-3">Checkout Reference</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($checkouts))
                            @forelse ($checkouts as $checkout)
                                <tr>
                                    <td class="p-0">
                                        <div class="card d-block border-0 rounded-0">
                                            <div class="card-header">
                                                <a href="#" data-target="#CheckOutReleaseItems{{ $checkout->id }}" data-toggle="collapse">{{ $checkout->reference_no }}</a>
                                            </div>
                                            <ul class="collapse list-group list-group-flush" id="CheckOutReleaseItems{{ $checkout->id }}">
                                                @forelse ($checkout->releaseItems as $releaseItem)
                                                <li class="list-group-item">
                                                    {{ $releaseItem->stock->toner->model_name }} - {{ $releaseItem->quantity }} Pc/s
                                                    <a href="#" data-target="#modalAddReturnItem{{ $releaseItem->id }}" data-toggle="modal" class="btn btn-sm btn-primary float-right">Add Return Item</a>
                                                    @include('includes.modals.returnItem.create')
                                                </li>
                                                @empty
                                                <li class="list-group-item">No item available</li>
                                                @endforelse
                                        </ul>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2"><center>No record/s to show.</center></td>
                                </tr>
                            @endforelse
                        @else
                            <tr>
                                <td colspan="2"><center>No record/s to show.</center></td>
                            </tr>
                        @endif
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    <div class="col-md-8">
        <table class="table table-sm table-stripe table-bordered">
            <tbody>
                <tr>
                    <th style="width:150px;">Location</th>
                    <td>{{ $returnReceive->location->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Date Received</th>
                    <td>{{ $returnReceive->date_received }}</td>
                </tr>
                <tr>
                    <th>Reason of return</th>
                    <td>{{$returnReceive->reasonOfReturn->value}}</td>
                </tr>
                <tr>
                    <th>Subject For</th>
                    <td>{{$returnReceive->subjectFor->value}}</td>
                </tr>
            </tbody>
        </table>
        @if (!$returnReceive->status)
            <a data-target="#modalConfirmCompleteReturnReceive" data-toggle="modal" class="btn btn-success text-white float-right"><i class="fas fa-check"></i> Set as completed</a>
            @include('includes.modals.returnReceive.set-complete')
        @else
            @if (!$returnReceive->returnReissue)
                <a data-target="#modalReturnReissueCreate" data-toggle="modal" class="btn btn-success float-right"><i class="fas fa-recycle"></i> Re-issue</a>
                @include('includes.modals.returnReissue.create')
            @endif
        @endif
        <br>
        <h4 class="mt-3"><strong>Items</strong></h4>
        <table class="table table-sm table-stripe table-hover table-bordered">
            <thead>
                <tr>
                    <th>Checkout Reference</th>
                    <th>Toner Model</th>
                    <th>Quantity</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($returnReceive->returnItems as $item)
                <tr>
                    <td>{{$item->releaseItem->checkOut->reference_no}}</td>
                    <td>{{$item->releaseItem->stock->toner->model_name}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>
                        @if (!$returnReceive->status)
                        {!! Form::open(['route' => ['returnItem.destroy', $item->id], 'method' => 'DELETE']) !!}
                        {{ Form::token() }}
                        {{ Form::hidden('return_receive_id', $returnReceive->id) }}
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        {!! Form::close() !!}
                        @else
                        <a class="btn btn-sm btn-secondary"><i class="fas fa-trash"></i></a>  
                        @endif
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="4">No record/s to show.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


@endsection
