@extends('layouts.app')

@section('content')
<div class="row">
  <h1 class="col-md-12 display-6">Off Record - {{ $offTheRecord->reference_no }}</h1>
  <a href="{{ route('offTheRecord.index') }}" class="btn btn-primary ml-3"><i class="fas fa-caret-left"></i> Off record list</a>
  <div class="col-md-12"><hr></div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Information</h4>
        {!! Form::model($offTheRecord, ['route' => ['offTheRecord.update', $offTheRecord->id], 'method' => 'PATCH']) !!}        
          @include('includes.forms.offTheRecord')
          <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Update</button>
          <button type="reset" class="btn btn-sm btn-danger"><i class="fas fa-times"></i> Reset</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>

  <div class="col-md-8">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Items</h4>
        <a href="#" data-toggle="modal" data-target="#modalOffTheRecordItemCreate" class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus"></i> Add</a>
        @include('includes.modals.offTheRecorditem.create')
        <table class="table table-sm table-stripe table-bordered">
          <thead>
            <tr>
              <th>Toner Model</th>
              <th>Type</th>
              <th>Quantity</th>
              <th>Option</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($offTheRecord->offTheRecordItems as $item)
              <tr>
                <td>{{ $item->toner->model_name }}</td>
                <td>{{ $item->toner->toner_type->name }}</td>
                <td>{{ $item->quantity }} {{ $item->toner->unit->name }}</td>
                <td>
                  <a href="#" data-toggle="modal" data-target="#modalOffTheRecordItemUpdate{{ $item->id }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                  @include('includes.modals.offTheRecordItem.update')
                </td>
              </tr>
            @empty
                <tr>
                  <td colspan="4">No available record.</td>
                </tr>
            @endforelse
          </tbody>
        </table>

        <p class="font-weight-bolder">Total: {{ $offTheRecord->TotalQuantity }}</p>
      </div>
    </div>
  </div>

</div>


@endsection


