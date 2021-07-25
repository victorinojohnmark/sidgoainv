<!-- Modal -->
<div class="modal fade" id="modalReturnReceiveCreate" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="modalReturnReceiveCreateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalReturnReceiveCreateLabel">Create Return</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => 'returnReceive.store', 'method' => 'post']) !!}
                <div class="modal-body">
                    
                    @include('includes.forms.returnReceive')
                    
                </div> <!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
                    <button type="reset" class="btn btn-sm btn-danger"><i class="fas fa-times"></i> Reset</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>