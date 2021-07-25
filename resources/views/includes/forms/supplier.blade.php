{{ Form::token() }}
<div class="form-row">
    <div class="form-group col-md-12">
        {{ Form::label('supplierName', 'Name') }}
        {{ Form::text('name', old('name'), ['id' => 'supplierName', 'class' => 'form-control', 'placeholder' => 'Supplier name...', 'required' => '', 'autofocus' => '']) }}
    </div>
    
    <div class="form-group col-md-12">
        {{ Form::label('vendorCode', 'Vendor Code') }}
        {{ Form::text('vendor_code', old('vendor_code'), ['id' => 'vendorCode', 'class' => 'form-control', 'placeholder' => 'Vendor code here...', 'required' => '']) }}
    </div>
    
    <div class="form-group col-md-6">
        {{ Form::label('contactPerson', 'Contact Person') }}
        {{ Form::text('contact_person', old('contact_person'), ['id' => 'contactPerson', 'class' => 'form-control', 'placeholder' => 'Contact person here...', 'required' => '']) }}
    </div>
    
    <div class="form-group col-md-6">
        {{ Form::label('contactNo', 'Contact No.') }}
        {{ Form::text('contact_no', old('contact_no'), ['id' => 'contactNo', 'class' => 'form-control', 'placeholder' => 'Contact no. here...', 'required' => '']) }}
    </div>
    
    <div class="form-group col-md-12">
        {{ Form::label('supplierEmail', 'Email Address') }}
        {{ Form::text('email', old('email'), ['id' => 'supplierEmail', 'class' => 'form-control', 'placeholder' => 'Email address here...', 'required' => '']) }}
    </div>
    
    <div class="form-group col-md-12">
        {{ Form::label('address', 'Address') }}
        {{ Form::textarea('address', old('address'), ['id' => 'address', 'class' => 'form-control', 'placeholder' => 'Address here...', 'rows' => '2', 'required' => '']) }}
    </div>
    <div class="form-group col-md-4">
        <div class="form-check col-md-4">
            <input type="checkbox" name="status" id="status" class="form-check-input" 
                @isset($supplier)
                {{ $supplier->status ? 'checked="checked"' : '' }}
                @else
                {{ 'checked="checked"' }}
                @endisset
            >
            <label for="status">Active</label>
        </div>
    </div>
</div>