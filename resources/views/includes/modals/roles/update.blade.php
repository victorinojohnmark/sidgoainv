<!-- Modal -->
<div class="modal fade" id="modalUpdateRole{{ $role->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="modalUpdateRoleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUpdateRoleLabel">Update role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'PATCH']) !!}
                <div class="modal-body">
                    
                    @include('includes.forms.role')
                    
                </div> <!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
                    <button type="reset" class="btn btn-sm btn-danger"><i class="fas fa-times"></i> Reset</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>