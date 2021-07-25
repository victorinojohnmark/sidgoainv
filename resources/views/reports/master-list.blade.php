@extends('layouts.report')

@section('content')


<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="toner-tab" data-toggle="tab" href="#toner" role="tab" aria-controls="home" aria-selected="true">Toners</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="supplier-tab" data-toggle="tab" href="#supplier" role="tab" aria-controls="profile" aria-selected="false">Suppliers</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="location-tab" data-toggle="tab" href="#location" role="tab" aria-controls="contact" aria-selected="false">Locations</a>
  </li>
</ul>
<div class="tab-content" id="tabContent">
  <div class="tab-pane fade show active pt-3" id="toner" role="tabpanel" aria-labelledby="toner-tab">
    <table class="display nowrap datatables table table-striped table-hover table-bordered" style="width:100%" data-export-title="Toners" data-datetime="{{ date('YmdHis') }}" data-orientation="portrait">
      <thead>
          <tr>
            <th style="width:20px !important"><center>#</center></th>
            <th>Model</th>
            <th>Type</th>
            <th>Unit</th>
            <th>ROP</th>
          </tr>
      </thead>
      <tbody>
        @forelse ($toners as $toner)
        <tr>
            <th><center>{{ $loop->index + 1}}</center></th>
            <td>{{ $toner->model_name }}</td>
            <td>{{ $toner->toner_type->name }}</td>
            <td>{{ $toner->unit->name }}</td>
            <td>{{ $toner->minimum_quantity }}</td>
        </tr>
        @empty
        @endforelse
      </tbody>
      <tfoot>
          <tr>
            <th style="width:20px !important"><center>#</center></th>
            <th>Model</th>
            <th>Type</th>
            <th>Unit</th>
            <th>Min. QTY.</th>
          </tr>
      </tfoot>
    </table>
  </div>

  <div class="tab-pane fade pt-3" id="supplier" role="tabpanel" aria-labelledby="supplier-tab">
    <table class="display nowrap datatables table table-striped table-hover table-bordered" style="width:100%" data-export-title="Suppliers" data-datetime="{{ date('YmdHis') }}" data-orientation="landscape" data-page-size="Legal">
      <thead>
          <tr>
            <th style="width:20px !important"><center>#</center></th>
            <th>Name</th>
            <th>Code</th>
            <th>Person</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Address</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($suppliers as $supplier)
        <tr>
            <th><center>{{ $loop->index + 1}}</center></th>
            <td>{{ $supplier->name }}</td>
            <td>{{ $supplier->vendor_code }}</td>
            <td>{{ $supplier->contact_person }}</td>
            <td>{{ $supplier->contact_no }}</td>
            <td>{{ $supplier->email }}</td>
            <td>{{ $supplier->address }}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
          <tr>
            <th style="width:20px !important"><center>#</center></th>
            <th>Name</th>
            <th>Code</th>
            <th>Person</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Address</th>
          </tr>
      </tfoot>
    </table>
  </div>

  <div class="tab-pane fade pt-3" id="location" role="tabpanel" aria-labelledby="location-tab">
    <table class="display nowrap datatables table table-striped table-hover table-bordered" style="width:100%" data-export-title="Locations" data-datetime="{{ date('YmdHis') }}" data-orientation="landscape" data-page-size="Legal">
      <thead>
          <tr>
            <th style="width:20px !important"><center>#</center></th>
            <th>Name</th>
            <th>Company</th>
            <th>Code</th>
            <th>Person</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Address</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($locations as $location)
        <tr>
            <th><center>{{ $loop->index + 1}}</center></th>
            <td>{{ $location->name }}</td>
            <td>{{ $location->company->code }}</td>
            <td>{{ $location->location_code }}</td>
            <td>{{ $location->contact_person }}</td>
            <td>{{ $location->contact_no }}</td>
            <td>{{ $location->email }}</td>
            <td>{{ $location->address }}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
          <tr>
            <th style="width:20px !important"><center>#</center></th>
            <th>Name</th>
            <th>Company</th>
            <th>Code</th>
            <th>Person</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Address</th>
          </tr>
      </tfoot>
    </table>
  </div>
</div>
    


@endsection
