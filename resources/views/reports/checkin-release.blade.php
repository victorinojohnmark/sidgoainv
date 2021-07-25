<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $page_title ?? 'Checkout' }} {{ $checkin->ReferenceNo }}</title>
  <link rel="stylesheet" href="{{ URL::asset('vendor/normalize/normalize.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('css/print.css') }}">
</head>
<body>
  <button class="print-button" onclick="window.print()">Print</button>
  <button class="print-button" onclick="selectElementContents( document.getElementById('table') );">Copy</button>
  
<table class="tbl" id="table">
  <thead>
    <tr>
      <th colspan="7"><h3>{{ $page_title ?? '' }}: {{ $checkin->ReferenceNo }} - Release Transaction</h3></th>
    </tr>
    <tr>
      <th>Toner Model</th>
      <th>Checkout Ref.</th>
      <th>DR</th>
      <th>Batch Code</th>
      <th>Sales Invoice</th>
      <th>PO</th>
      <th>Delivery Date</th>
    </tr>
  </thead>
  <tbody>
      @forelse ($checkin->stocks as $stock)
        @foreach ($stock->ReleaseItemCompleted as $item)
            <tr>
              <td>{{ $item->stock->toner->model_name }}</td>
              <td>{{ $item->checkOut->ReferenceNo }}</td>
              <td>{{ $item->checkOut->dr_no }}</td>
              <td>{{ $item->stock->checkIn->toner_code }}</td>
              <td>{{ $item->checkOut->invoice_no }}</td>
              <td>{{ $item->checkOut->po_no }}</td>
              <td>{{ $item->checkOut->delivery_date }}</td>
            </tr>
        @endforeach
      @empty
          <tr>
            <td colspan="7">No record found.</td>
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