

{{ Form::token() }}
<div class="form-row">
    {{ Form::hidden('location_id', $checkout->location_id) }}
    <div class="form-group col-md-6">
        {{ Form::label('po_no', 'PO No.') }}
        {{ Form::text('po_no', old('po_no'), ['placeholder' => 'PO no here...', 'id' => 'po_no', 'class' => 'form-control', 'required' => '']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('request_slip_no', 'Request Slip no') }}
        {{ Form::text('request_slip_no', old('request_slip_no'), ['placeholder' => 'Request slip no here...', 'id' => 'request_slip_no', 'class' => 'form-control', 'required' => '']) }}
    </div>
    <br>
    <div class="form-group col-md-12">
        {{ Form::label('note', 'Note') }}
        {{ Form::textarea('note', old('note'), ['id' => 'note', 'class' => 'form-control', 'placeholder' => 'Note here...', 'rows' => '2']) }}
    </div>

    {{ Form::hidden('parent_checkout_id', $checkout->id ?? '') }}

</div>