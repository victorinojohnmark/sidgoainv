{{ Form::token() }}
<div class="form-row">
    <div class="form-group col-md-12">
        {{ Form::label('modelName', 'Model Name') }}
        {{ Form::text('model_name', old('model_name'), ['id' => 'modelName', 'class' => 'form-control', 'placeholder' => 'Model name...', 'required' => '', 'autofocus' => '']) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('tonerType', 'Toner Type') }}
        {{ Form::select('toner_type_id', $toner_types, old('toner_type_id'), ['placeholder' => 'Select here...', 'id' => 'tonerType', 'class' => 'form-control', 'required' => '']) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('minimunQuantity', 'ROP') }}
        {{ Form::number('minimum_quantity', old('minimum_quantity'), ['id' => 'minimunQuantity', 'class' => 'form-control', 'placeholder' => 'Minimum qty. here...', 'required' => '', 'autofocus' => '']) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('unit', 'Unit') }}
        {{ Form::select('unit_id', $units, old('unit_id'), ['placeholder' => 'Select here...', 'id' => 'unit', 'class' => 'form-control', 'required' => '']) }}
    </div>
    <div class="form-group col-md-4">
        <div class="form-check col-md-4">
            <input type="checkbox" name="status" id="status" class="form-check-input" 
                @isset($toner)
                {{ $toner->status ? 'checked="checked"' : '' }}
                @else
                {{ 'checked="checked"' }}
                @endisset
            >
            <label for="status">Active</label>
        </div>
    </div>
</div>

