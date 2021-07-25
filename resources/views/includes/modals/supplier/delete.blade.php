<!-- Modal -->
<div class="modal fade" id="modalDeleteSupplier{{ $supplier->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
aria-labelledby="modalDeleteSupplierLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalDeleteSupplierTitle">Confirm delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {!! Form::open(['route' => ['suppliers.destroy', $supplier->id], 'class' => 'd-inline', 'method' => 'DELETE']) !!}
        {{ Form::token() }}
            <div class="modal-body">
                <p>Are you sure you want to delete?</p>
            </div> <!-- modal-body -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-primary">Cancel</button>
            </div>
        {!! Form::close() !!}

    </div>
</div>
</div>