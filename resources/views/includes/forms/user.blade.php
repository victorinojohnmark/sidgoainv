{{ Form::token() }}
<div class="form-row">
    <div class="form-group col-md-12">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', old('name'), ['placeholder' => 'Fullname here...', 'class' => 'form-control', 'id' => 'name', 'required' => '', 'autofocus' => '']) }}
    </div>

    <div class="form-group col-md-12">
        {{ Form::label('username', 'Username') }}
        {{ Form::text('username', old('username'), ['placeholder' => 'Username here...', 'class' => 'form-control', 'id' => 'username', 'required' => '']) }}
    </div>
    <div class="form-group col-md-12">
        {{ Form::label('email', 'Email address') }}
        {{ Form::text('email', old('email'), ['placeholder' => 'Email here...', 'class' => 'form-control', 'id' => 'email', 'required' => '']) }}
    </div>
    <div class="form-group col-md-12">
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password', ['placeholder' => 'Password here...', 'class' => 'form-control', 'id' => 'password', 'required' => '']) }}
    </div>
    <div class="form-group col-md-12">
        {{ Form::label('confirm-password', 'Confirm Password') }}
        {{ Form::password('confirm-password', ['placeholder' => 'Confirm Password here...', 'class' => 'form-control', 'id' => 'confirm-password', 'required' => '']) }}
    </div>
    <div class="form-group col-md-12">
        {{ Form::label('roles', 'Roles') }}
        {{ Form::select('roles[]', $roles, [], ['id' => 'roles', 'class' => 'form-control', 'multiple' => '', 'required' => '']) }}
    </div>
</div>