<!-- Modal -->
<div class="modal fade" id="modalconfirmCompleted" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="modalconfirmCompletedLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalconfirmCompletedLabel">Set as completed?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            {!! Form::open(['url' => '/checkins/set_completed/'.$checkin->id, 'method' => 'patch']) !!}
            {{ Form::token() }}
            {{ Form::hidden('set_complete', 1, ['required' => '']) }}
            <div class="modal-body">
                Please confirm to complete.
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-primary">Confirm</button>
            </div>
            
            {!! Form::close() !!}
            
        </div>
    </div>
</div>