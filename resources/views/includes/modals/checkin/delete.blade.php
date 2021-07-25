<!-- Modal -->
<div class="modal fade" id="modalDeleteCheckin{{ $checkin->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="modalDeleteCheckin{{ $checkin->id }}Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="modalDeleteCheckin{{ $checkin->id }}Label">Confirm Delete</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          
              <div class="modal-body">
                Are you sure you want to delete?
                <table class="table table-sm table-striped table-bordered">
                  <tr>
                    <th>Reference #</th>
                    <th>Toner Code</th>
                    <th>Invoice #</th>
                    <th>OR #</th>
                    <th>QTY.</th>
                    <th>Purchased Cost</th>
                    <th>Purchased Date</th>
                    <th>Supplier</th>
                    <th class="th-50">Status</th>
                  </tr>
                  <tr>
                    <td>{{ $checkin->ReferenceNo }}</td>
                    <td>{{ $checkin->toner_code }}</td>
                    <td>{{ $checkin->invoice_no }}</td>
                    <td>{{ $checkin->or_no }}</td>
                    <td>{{ $checkin->TotalQuantity }}</td>
                    <td>&#8369; {{ number_format($checkin->purchased_cost, 2) }}</td>
                    <td>{{ $checkin->purchased_date }}</td>
                    <td>{{ $checkin->supplier->vendor_code }}</td>
                    <td>
                      <center>
                          @if ($checkin->status)
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
                  Items under this checkin will be deleted.
                </small>
              </div>
                  
              </div> <!-- modal-body -->
              <div class="modal-footer">
                {!! Form::model($checkin, ['route' => ['checkins.destroy', $checkin->id], 'method' => 'DELETE']) !!}
                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal"><i class="fas fa-cancel"></i> Cancel</button>
                {!! Form::close() !!}
              </div>
          
      </div>
  </div>
</div>