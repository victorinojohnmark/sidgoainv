<!-- Modal -->
<div class="modal fade" id="deleteModalReleaseItem{{ $releaseItem->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="deleteModalReleaseItem{{ $releaseItem->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalReleaseItem{{ $releaseItem->id }}Label">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to delete?</p>
              <table class="table table-sm table-striped table-bordered">
                <tr>
                  <th>Check-in Reference ID</th>
                  <th>Stock ID #</th>
                  <th>Toner Model</th>
                  <th>Quantity</th>
                  <th>Note</th>
                </tr>
                <tr>
                  <td>{{ $releaseItem->stock->checkIn->ReferenceNo }}</td>
                  <td>{{ $releaseItem->stock->IDNo }}</td>
                  <td>{{ $releaseItem->stock->toner->model_name }}</td>
                  <td>{{ $releaseItem->quantity }}</td>
                  <td>{{ $releaseItem->note ?? 'n/a'}}</td>
                </tr>
            </table>
            </div>
            <div class="modal-footer">
              {!! Form::open(['route'=>['releaseitems.destroy',$releaseItem->id], 'method' => 'DELETE']) !!}
                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal"><i class="fas fa-cancel"></i> Cancel</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>