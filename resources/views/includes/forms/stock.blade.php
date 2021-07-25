{{ Form::token() }}
{{ Form::hidden('check_in_id', old('check_in_id', $checkin->id), ['required' => '']) }}
<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('toner', 'Toner') }}
        {{ Form::select('toner_id', $toners, old('toner_id'), ['placeholder' => 'Select here...', 'id' => 'toner', 'class' => 'form-control', 'required' => '']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('quantity', 'Quantity') }}
        {{ Form::number('quantity', old('quantity'), ['id' => 'quantity', 'class' => 'form-control', 'placeholder' => 'Quantity here...', 'required' => '']) }}
    </div>
</div>