{{ Form::token() }}
<div class="form-row">
    <div class="form-group col-md-12">
        {{ Form::label('tonerCode', 'Batch Code') }}
        {{ Form::text('toner_code', old('toner_code'), ['id' => 'tonerCode', 'class' => 'form-control', 'placeholder' => 'Batch code here...', 'required' => '', 'autofocus' => '']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('invoiceNo', 'Invoice No.') }}
        {{ Form::text('invoice_no', old('invoice_no'), ['id' => 'invoiceNo', 'class' => 'form-control', 'placeholder' => 'Invoice no. here...', 'required' => '']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('orNo', 'OR No.') }}
        {{ Form::text('or_no', old('or_no'), ['id' => 'orNo', 'class' => 'form-control', 'placeholder' => 'OR no. here...', 'required' => '']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('purchasedDate', 'Purchased Date') }}
        {{ Form::date('purchased_date', old('purchased_date'), ['id' => 'purchasedDate', 'class' => 'form-control', 'placeholder' => 'Date here...', 'required' => '']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('purchasedCost', 'Purchased Cost') }}
        {{ Form::text('purchased_cost', old('purchased_cost'), ['id' => 'purchasedCost', 'class' => 'form-control', 'placeholder' => 'Cost here...', 'required' => '']) }}
    </div>
    <div class="form-group col-md-12">
        {{ Form::label('supplier', 'Supplier') }}
        {{ Form::select('supplier_id', $suppliers, old('supplier_id'), ['placeholder' => 'Select supplier...', 'id' => 'supplier', 'class' => 'form-control', 'required' => '']) }}
    </div>
    <div class="form-group col-md-12">
        {{ Form::label('note', 'Note') }}
        {{ Form::textarea('note', old('note'), ['id' => 'note', 'class' => 'form-control', 'placeholder' => 'Note here...', 'rows' => '2']) }}
    </div>
</div>