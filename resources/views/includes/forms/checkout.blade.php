{{ Form::token() }}
<div class="form-row">
    <div class="form-group col-md-12">
        {{ Form::label('locationId', 'Location') }}
        {{ Form::select('location_id', $locations, old('location_id'), ['placeholder' => 'Select location...', 'id' => 'locationId', 'class' => 'form-control', 'required' => '']) }}
    </div>
    {{-- <div class="form-group col-md-6">
        {{ Form::label('invoice_no', 'Sales Invoice') }}
        {{ Form::text('invoice_no', old('invoice_no'), ['placeholder' => 'Sales Invoice no here...', 'id' => 'invoice_no', 'class' => 'form-control', 'required' => '']) }}
    </div> --}}
    <div class="form-group col-md-6">
        {{ Form::label('po_no', 'PO No.') }}
        {{ Form::text('po_no', old('po_no'), ['placeholder' => 'PO no here...', 'id' => 'po_no', 'class' => 'form-control', 'required' => '']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('request_slip_no', 'Request Slip no') }}
        {{ Form::text('request_slip_no', old('request_slip_no'), ['placeholder' => 'Request slip no here...', 'id' => 'request_slip_no', 'class' => 'form-control', 'required' => '']) }}
    </div>
    <br>
    {{-- <div class="form-group col-md-6">
        {{ Form::label('deliveryStatus', 'Delivery Status') }}
        {{ Form::select('delivery_status_id', $delivery_statuses, old('delivery_status_id'), ['placeholder' => 'Select delivery status...', 'id' => 'deliveryStatus', 'class' => 'form-control', 'required' => '']) }}
    </div> --}}
    
    
    <div class="form-group col-md-12">
        {{ Form::label('note', 'Note') }}
        {{ Form::textarea('note', old('note'), ['id' => 'note', 'class' => 'form-control', 'placeholder' => 'Note here...', 'rows' => '2']) }}
    </div>

    <div class="form-group col-md-4">
        <div class="form-check">
            <input type="checkbox" name="return_to_supplier" id="status" class="form-check-input" 
                @isset($checkout)
                {{ $checkout->return_to_supplier ? 'checked="checked"' : '' }}
                @endisset
            >
            <label for="status">Return to supplier</label>
        </div>
    </div>

</div>