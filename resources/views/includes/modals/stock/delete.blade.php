<!-- Modal -->
<div class="modal fade" id="modalDeleteStock{{ $stock->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="modalDeleteStock{{ $stock->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteStock{{ $stock->id }}Label">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete?</p>
                <table class="table table-sm table-striped table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Toner</th>
                        <th>Type</th>
                        <th>Qty.</th>
                        <th>Units</th>
                    </tr>
                    <tr>
                        <td>{{ $stock->IDNo }}</td>
                        <td>{{ $stock->toner->model_name }}</td>
                        <td>{{ $stock->toner->toner_type->name }}</td>
                        <td>{{ $stock->quantity }}</td>
                        <td>{{ $stock->toner->unit->name }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                {!! Form::open(['route'=>['stocks.destroy',$stock->id], 'method' => 'DELETE']) !!}
                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal"><i class="fas fa-cancel"></i> Cancel</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>