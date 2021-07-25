<!-- Modal -->
<div class="modal fade" id="modalDeleteCheckout{{ $checkout->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="modalDeleteCheckoutLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="modalDeleteCheckoutLabel">Confirm Delete</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
            <div class="modal-body">
              Are you sure you want to delete?
              <table class="table table-sm table-striped table-bordered">
                <tr>
                  <th>Reference #</th>
                  <th>Location</th>
                  <th>DR No.</th>
                  <th>Sales Invoice</th>
                  <th>PO No.</th>
                  <th>Toner Code</th>
                  <th>Req. Slip No.</th>
                  <th>Delivery Date</th>
                  <th>Delivery Status</th>
                  <th class="th-50">Status</th>
                </tr>
                <tr>
                  <td>{{ $checkout->ReferenceNo }}</td>
                  <td>{{ $checkout->location->location_code }}</td>
                  <td>{{ $checkout->dr_no }}</td>
                  <td>{{ $checkout->invoice_no }}</td>
                  <td>{{ $checkout->po_no }}</td>
                  <td>{{ $checkout->toner_code }}</td>
                  <td>{{ $checkout->request_slip_no }}</td>
                  <td>{{ $checkout->delivery_date }}</td>
                  <td>{{ $checkout->DeliveryStatus }}</td>
                  <td>
                    <center>
                        @if ($checkout->status)
                        <i class="fas fa-check-circle text-success"></i>
                        @else
                        <i class="fas fa-minus-circle text-danger"></i>
                        @endif
                    </center> 
                </td>
                </tr>
            </table>
            <div class="alert alert-info" role="alert">
              <small><i class="fas fa-info"></i>&nbsp;&nbsp;
                Items under this checkout will be deleted.
              </small>
            </div>
            </div> <!-- modal-body -->
            <div class="modal-footer">
              {!! Form::open(['route'=>['checkouts.destroy',$checkout->id], 'method' => 'DELETE']) !!}
              <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
              <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal"><i class="fas fa-cancel"></i> Cancel</button>
              {!! Form::close() !!}
            </div>
      </div>
  </div>
</div>