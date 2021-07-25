{{ Form::token() }}
<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('reissue_type', 'Re-issue Type') }}
        {{ Form::select('reissue_type_id', $reissue_types, old('reissue_type_id'), ['placeholder' => 'Select here...', 'id' => 'reissue_type', 'class' => 'form-control', 'required' => '']) }}
    </div>
    {{ Form::hidden('return_receive_id', old('return_receive_id', $returnReissue->return_receive_id ?? $returnReceive->id)) }}

    <div class="form-group col-md-6">
        {{ Form::label('delivery_date', 'Delivery Date') }}
        {{ Form::date('delivery_date', old('delivery_date'), ['placeholder' => 'Delivery date here...', 'id' => 'delivery_date', 'class' => 'form-control']) }}
    </div>
</div>



