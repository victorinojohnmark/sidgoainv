@extends('layouts.report')

@section('content')

<h3 class="mb-3">Stocks per toner</h3>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#onStock" role="tab" aria-controls="home" aria-selected="true">On Stock</a>
  </li>
  <li class="nav-item" role="presentation">
      <a class="nav-link text-danger" id="profile-tab" data-toggle="tab" href="#lowStock" role="tab" aria-controls="profile" aria-selected="false">Low Stock</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active pt-3" id="onStock" role="tabpanel" aria-labelledby="home-tab">
      <table class="display nowrap datatables table table-striped table-hover table-bordered" 
      style="width:100%" 
      data-export-title="Item Count - On Stock" 
      data-datetime="{{ date('YmdHis') }}" 
      data-orientation="portrait">
          <thead>
              <tr>
                  <tr>
                      <th>#</th>
                      <th>Model</th>
                      <th>Type</th>
                      <th>Current Stock</th>
                      <th>ROP</th>
                  </tr>
              </tr>
          </thead>
          <tbody>
              @php $ctr = 1; @endphp
              @forelse ($toners as $toner)
                  @if ($toner->CurrentStock >= $toner->minimum_quantity)
                  <tr>
                      <td>{{ $ctr++ }}</td>
                      <td>
                          <a href="#" data-toggle="modal" data-target="#modalShowToner{{ $toner->id }}">{{ $toner->model_name }}</a>
                          {{-- @include('includes.modals.toner.show') --}}
                      </td>
                      <td>{{ $toner->toner_type->name }}</td>
                      <td>{{ $toner->CurrentStock }}</td>
                      <td>{{ $toner->minimum_quantity }}</td>
                  </tr>   
                  @endif
              @empty

              @endforelse
          </tbody>
      </table>
  </div>
  <div class="tab-pane fade pt-3" id="lowStock" role="tabpanel" aria-labelledby="profile-tab">
      <table class="display nowrap datatables table table-striped table-hover table-bordered" 
      style="width:100%" 
      data-export-title="Item Count - Low Stock" 
      data-datetime="{{ date('YmdHis') }}" 
      data-orientation="portrait">
          <thead>
              <tr>
                  <tr>
                      <th>#</th>
                      <th>Model</th>
                      <th>Type</th>
                      <th>Current Stock</th>
                      <th>ROP</th>
                  </tr>
              </tr>
          </thead>
          <tbody>
              @php $ctr = 1; @endphp
              @forelse ($toners as $toner)
                  @if ($toner->CurrentStock < $toner->minimum_quantity)
                  <tr>
                      <td>{{ $ctr++ }}</td>
                      <td>
                          <a href="#" data-toggle="modal" data-target="#modalShowToner{{ $toner->id }}">{{ $toner->model_name }}</a>
                          {{-- @include('includes.modals.toner.show') --}}
                      </td>
                      <td>{{ $toner->toner_type->name }}</td>
                      <td class="text-danger">{{ $toner->CurrentStock }}</td>
                      <td>{{ $toner->minimum_quantity }}</td>
                  </tr>   
                  @endif
              @empty

              @endforelse
      </table>
  </div>
</div>

</div>


    


@endsection
