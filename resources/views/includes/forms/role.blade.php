{{ Form::token() }}
<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', old('name'), ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Role name...', 'required' => '', 'autofocus' => '']) }}
    </div>

    <div class="form-group col-md-6">
        {{ Form::label('description', 'Description') }}
        {{ Form::text('description', old('description'), ['id' => 'description', 'class' => 'form-control', 'placeholder' => 'Description here...']) }}
    </div>

    <div class="form-group col-md-12">
        <hr>
        {{ Form::label('Permissions') }}
    </div>

    @foreach ($permissions as $permission)
    <div class="form-group col-md-4">
        <div class="form-check">
            {{ Form::checkbox('permission[]', $permission->id, in_array($permission->id, $role->RolePermissions ?? []) ? true : false, ['class' => 'form-check-input', 'id' => 'defaultCheck'.$permission->id]) }}
            {{ Form::label('defaultCheck'.$permission->id, $permission->name, ['class' => 'form-check-label']) }}
            {{-- <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">
                Default checkbox
            </label> --}}
        </div>
        {{-- <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permission[]', $permission->id, in_array($permission->id, $role->RolePermissions ?? []) ? true : false, ['class' => 'custom-control-input', 'id' => 'customCheck'.$permission->id]) }}
            {{ Form::label('customCheck'.$permission->id, $permission->name, ['class' => 'custom-control-label']) }}
            <input type="checkbox" class="" id="customCheck">
            <label class="custom-control-label" for="customCheck">Check this custom checkbox</label>
        </div> --}}
    </div>
    @endforeach

    

    
</div>