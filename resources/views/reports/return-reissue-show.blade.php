<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $page_title ?? 'Reissue' }} {{ $returnReissue->reference_no }}</title>
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
@if ($returnReissue->reissue_type_id <> 2)
  @if ($returnReissue->status)
  <button class="print-button" onclick="window.print()">Print</button>
  <button class="print-button" onclick="selectElementContents( document.getElementById('table') );">Copy</button>
  <br>
  <table>
    <tr>
      <td rowspan="4" style="width:60px; padding:10px;">
        <img src="/image/{{ $returnReissue->returnReceive->location->company->logo }}" alt="HRM Logo" style="width:100%;">
      </td>
    </tr>
    <tr>
      <td><h2>{{ $returnReissue->returnReceive->location->company->name }}</h2></td>
    </tr>
    <tr>
      <td>{{ $returnReissue->returnReceive->location->company->address }}</td>
    </tr>
    <tr>
      <td>Tel.: {{ $returnReissue->returnReceive->location->company->contact }} Email: {{ $returnReissue->returnReceive->location->company->email }}</td>
    </tr> 
  </table>
  <br>
  <table class="tbl" id="table" style="margin-top: 20px;">
    <thead>
      <tr>
        <th>Location</th>
        <td colspan="5">{{ $returnReissue->returnReceive->location->name }}</td>
      </tr>
      <tr>
        <th>Address</th>
        <td colspan="5">{{ $returnReissue->returnReceive->location->address }}</td>
      </tr>
      <tr>
        <th>Contact Person</th>
        <td colspan="5">{{ $returnReissue->returnReceive->location->contact_person }}</td>
      </tr>
      <tr>
        <th>Contact No.</th>
        <td colspan="5">{{ $returnReissue->returnReceive->location->contact_no }}</td>
      </tr>
      
      <tr>
        <th colspan="6"><h3>{{ $page_title ?? '' }}: {{ $returnReissue->reference_no }}</h3></th>
      </tr>
      <tr>
          <th>Delivery Date</th>
          <td colspan="5">{{ $returnReissue->delivery_date ?? 'N/A' }}</td>
      </tr>
      <tr>
        <th>DR No</th>
        <td colspan="5">{{ $returnReissue->dr_no ?? 'N/A' }}</td>
      </tr>
      <tr>
        <th>Delivered by</th>
        <td colspan="5"></td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th colspan="6"><h4>Items</h4></th>
      </tr>
      <tr>
        <th colspan="3">Toner</th>
        <th>Type</th>
        <th>Total Qty</th>
        <th>Units</th>
      </tr>
      @forelse ($returnReissue->returnReceive->returnItems as $item)
      <tr>
          <td colspan="3">{{ $item->releaseItem->stock->toner->model_name }}</td>
          <td>{{ $item->releaseItem->stock->toner->toner_type->name }}</td>
          <td>{{ $item->quantity }}</td>
          <td>{{ $item->releaseItem->stock->toner->unit->name }}</td>
      </tr>
      @empty
          <tr>
              <td colspan="4">No record found.</td>
          </tr>
      @endforelse
    </tbody>
  </table>

  <div style="width:250px;float:right;position:fixed;bottom:0;right:0;padding:30px 20px;text-align:center;">
    <p class="p-bottom mt-50">Authorized Signature & Printed Name</p>
    <p class="p-bottom mt-50">Date Received</p>
  </div>

  <div style="width:250px;float:left;position:fixed;bottom:0;left:0;padding:30px 20px;text-align:center;">
    <p style="height:25px;"><strong>ACD</strong></p>
    <p class="p-bottom">Prepared By</p>
    <p style="height:25px;"><strong>GOA</strong></p>
    <p class="p-bottom">Approved By</p>
  </div>
  @else
  <p>Cannot view report....</p>
  @endif
@else
  <p>Cannot view report.</p>
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