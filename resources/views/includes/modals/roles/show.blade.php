<!-- Modal -->
<div class="modal fade" id="modalViewRole{{ $role->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="modalViewRoleLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalViewRoleLabel"><strong>{{ $role->name }}</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Permissions</p>
                @forelse ($role->roleHasPermissions as $roleHasPermission)
                <span class="badge badge-primary">{{ $roleHasPermission->permission->name }}</span>
                @empty
                No permission.
                @endforelse
                
            </div>
            
        </div>
    </div>
</div>