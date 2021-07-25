{{ Form::token() }}
<div class="form-row">
    {{ Form::hidden('off_the_record_id', $offTheRecord->id) }}
  <div class="form-group col-md-6">
    {{ Form::label('toner', 'Toner Model') }}
    {{ Form::select('toner_id', $toners, old('toner_id'), ['placeholder' => 'Select toner here...', 'id' => 'toner', 'class' => 'form-control', 'required' => '']) }}
  </div>

  <div class="form-group col-md-6">
    {{ Form::label('quantity', 'Quantity') }}
    {{ Form::text('quantity', old('quantity'), ['id' => 'quantity', 'class' => 'form-control', 'placeholder' => 'Quantity here...', 'required' => '']) }}
  </div>
  
</div>