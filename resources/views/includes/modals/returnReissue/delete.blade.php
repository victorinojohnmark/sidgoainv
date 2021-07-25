<!-- Modal -->
<div class="modal fade" id="modalDeleteReturnReissue{{ $returnReissue->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="modalDeleteReturnReissue{{ $returnReissue->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteReturnReissue{{ $returnReissue->id }}Label">Delete re-issue</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => ['returnReissue.destroy', $returnReissue->id], 'method' => 'DELETE']) !!}
                {{ Form::token() }}
                <div class="modal-body">
                 <p>Are you sure you want to delete {{ $returnReissue->reference_no }}</p>            
                    
                </div> <!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Confirm Delete</button>
                    <button type="button" data-dismiss="modal" class="btn btn-sm btn-primary"><i class="fas fa-times"></i> Close</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>