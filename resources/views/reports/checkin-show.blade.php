<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $page_title ?? 'Checkin' }} {{ $checkin->ReferenceNo }}</title>
  <link rel="stylesheet" href="{{ URL::asset('vendor/normalize/normalize.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('css/print.css') }}">
</head>
<body>
  <button class="print-button" onclick="window.print()">Print</button>
  <button class="print-button" onclick="selectElementContents( document.getElementById('table') );">Copy</button>
  
<table class="tbl" id="table">
  <thead>
    <tr>
      <th colspan="7"><h3>{{ $page_title ?? '' }}: {{ $checkin->ReferenceNo }}</h3></th>
    </tr>
    <tr>
      <th>Batch Code</th>
      <th>Invoice</th>
      <th>OR</th>
      <th>Qty</th>
      <th>Purchased Cost</th>
      <th>Purchased Date</th>
      <th>Supplier</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td>{{ $checkin->toner_code }}</td>
        <td>{{ $checkin->invoice_no }}</td>
        <td>{{ $checkin->or_no }}</td>
        <td>{{ $checkin->TotalQuantity }}</td>
        <td>&#8369; {{ number_format($checkin->purchased_cost, 2) }}</td>
        <td>{{ $checkin->return_reissue_id ? 'N/A' : $checkin->purchased_date }}</td>
        <td>
          {{-- {{ $checkin->return_reissue_id ? 'N/A' : $checkin->supplier->name }} --}}
          @if ($checkin->return_reissue_id) 
          <span class="badge badge-info text-white">Return Items: {{ $checkin->returnReissue->reference_no }}</span> 
          @else
          {{ $checkin->supplier->vendor_code }}
          @endif
        </td>
    </tr>
    <tr>
      <th colspan="7">
        <h4>Item Summary</h4>
      </th>
    </tr>
    <tr>
      <th>ID</th>
      <th>Toner</th>
      <th>Type</th>
      <th>QTY.</th>
      <th>Units</th>
    </tr>
    @forelse ($checkin->stocks as $stock)
        <tr>
          <td>{{ $stock->IDNo }}</td>
          <td>{{ $stock->toner->model_name }}</td>
          <td>{{ $stock->toner->toner_type->name }}</td>
          <td>{{ $stock->quantity }}</td>
          <td>{{ $stock->toner->unit->name }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="6"><center>No record/s.</center></td>
        </tr>
    @endforelse
  </tbody>
</table>

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