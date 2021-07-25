{{ Form::token() }}
{{ Form::hidden('user_id', $user->id, ['required' => '']) }}
<div class="form-row">
    <div class="form-group col-md-12">
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password', ['placeholder' => 'Password here...', 'class' => 'form-control', 'id' => 'password', 'required' => '']) }}
    </div>
    <div class="form-group col-md-12">
        {{ Form::label('confirm-password', 'Confirm Password') }}
        {{ Form::password('confirm-password', ['placeholder' => 'Confirm Password here...', 'class' => 'form-control', 'id' => 'confirm-password', 'required' => '']) }}
    </div>
</div>