<!-- Modal -->
<div class="modal fade" id="modalConfirmCompleteReturnReceive" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="modalConfirmCompleteReturnReceiveLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalConfirmCompleteReturnReceiveLabel">{{ $returnReceive->reference_no }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['url' => '/returnReceive/setCompleted/'.$returnReceive->id, 'method' => 'PATCH']) !!}
                <div class="modal-body">
                    
                    <p>Do you wish to set this as completed? Please confirm.</p>
                    
                </div> <!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Confirm Complete</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>