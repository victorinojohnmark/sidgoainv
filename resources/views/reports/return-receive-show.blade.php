<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $page_title ?? 'Reissue' }} {{ $returnReceive->reference_no }}</title>
  <link rel="stylesheet" href="{{ URL::asset('vendor/normalize/normalize.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('css/print.css') }}">

  <style style="text/css">
    .p-bottom {
      padding-top:10px;
      border-top:2px solid black;
    }

    .mt-50 {
      margin-top: 50px;
    }
  </style>
</head>
<body>
{{-- {{ dd($returnReceive) }} --}}
@if ($returnReceive->status)
<h1 class="display-6">{{ $page_title ?? 'Page Title'}}</h1>

<button class="print-button" onclick="window.print()">Print</button>
<button class="print-button" onclick="selectElementContents( document.getElementById('table') );">Copy</button>
<table class="tbl" id="table" style="margin-top: 20px;">
  <tbody>
      <tr>
          <th style="width:150px;">Location</th>
          <td colspan="2">{{ $returnReceive->location->name ?? 'N/A' }}</td>
      </tr>
      <tr>
          <th>Date Received</th>
          <td colspan="2">{{ $returnReceive->date_received }}</td>
      </tr>
      <tr>
          <th>Reason of return</th>
          <td colspan="2">{{$returnReceive->reasonOfReturn->value}}</td>
      </tr>
      <tr>
          <th>Subject For</th>
          <td colspan="2">{{$returnReceive->subjectFor->value}}</td>
      </tr>
      <tr>
        <td colspan="3"><h4 class="mt-3"><strong>Items</strong></h4></td>
      </tr>
      <tr>
        <th>Checkout Reference</th>
        <th>Toner Model</th>
        <th>Quantity</th>
      </tr>
      @forelse ($returnReceive->returnItems as $item)
      <tr>
          <td>{{$item->releaseItem->checkOut->reference_no}}</td>
          <td>{{$item->releaseItem->stock->toner->model_name}}</td>
          <td>{{$item->quantity}}</td>
      </tr>
      @empty
          <tr>
              <td colspan="4">No record/s to show.</td>
          </tr>
      @endforelse
      
  </tbody>
</table>
@else
{{ 'Cannot view, pending status...' }}
@endif

<script>
  function selectElementContents(el) {
    var body = document.body,
      range, sel;
    if (document.createRange && window.getSelection) {
      range = document.createRange();
      sel = window.getSelection();
      sel.removeAllRanges();
      range.selectNodeContents(el);
      sel.addRange(range);
    }
    document.execCommand("Copy");
    document.getSelection().removeAllRanges();
  }
</script>



</body>
</html>

