{{ Form::token() }}
{{ Form::hidden('check_out_id', old('check_out_id', $checkout->id), ['required' => '']) }}
<div class="form-row">  
    <div class="form-group col-md-5">
        {{ Form::label('toner_model', 'Toner Model') }}
        {{ Form::select('toner_model', $toners, old('toner_model'), ['placeholder' => 'Select here...', 'id' => 'toner_model', 'class' => 'form-control tonerSelector', 'required' => '']) }}
    </div>
    <div class="form-group col-md-7">
        {{ Form::label('stock_id', 'Stocks') }}
        {{ Form::select('stock_id', [], old('stock_id'), ['placeholder' => 'Select here...', 'id' => 'stock_id', 'class' => 'form-control stockSelector', 'required' => '']) }}
    </div>
    <div class="form-group col-md-5">
        {{ Form::label('quantity', 'Quantity') }}
        {{ Form::number('quantity', old('quantity'), ['id' => 'quantity', 'min' => '1', 'class' => 'form-control', 'placeholder' => 'Quantity here...', 'required' => '']) }}
    </div>
    <div class="form-group col-md-12">
        {{ Form::label('note', 'Note') }}
        {{ Form::textarea('note', old('note'), ['id' => 'note', 'class' => 'form-control', 'placeholder' => 'Note here...', 'rows' => '2']) }}
    </div>

</div>