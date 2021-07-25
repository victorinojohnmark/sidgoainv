{{ Form::token() }}
<div class="form-row">
    <div class="form-group col-md-12">
        {{ Form::label('locationName', 'Name') }}
        {{ Form::text('name', old('name'), ['id' => 'locationName', 'class' => 'form-control', 'placeholder' => 'Client/Location name...', 'required' => '', 'autofocus' => '']) }}
    </div>

    <div class="form-group col-md-6">
        {{ Form::label('company', 'Company') }}
        {{ Form::select('company_id', $companies, old('company_id'), ['placeholder' => 'Select company...', 'id' => 'company', 'class' => 'form-control', 'required' => '']) }}
    </div>

    <div class="form-group col-md-6">
        {{ Form::label('locationCode', 'Location Code') }}
        {{ Form::text('location_code', old('location_code'), ['id' => 'locationCode', 'class' => 'form-control', 'placeholder' => 'Location code here...', 'required' => '']) }}
    </div>

    <div class="form-group col-md-6">
        {{ Form::label('contactPerson', 'Contact Person') }}
        {{ Form::text('contact_person', old('contact_person'), ['id' => 'contactPerson', 'class' => 'form-control', 'placeholder' => 'Fullname here...', 'required' => '']) }}
    </div>

    <div class="form-group col-md-6">
        {{ Form::label('contactNo', 'Contact No.') }}
        {{ Form::text('contact_no', old('contact_no'), ['id' => 'contactNo', 'class' => 'form-control', 'placeholder' => 'Contact no. here...', 'required' => '']) }}
    </div>

    <div class="form-group col-md-12">
        {{ Form::label('emailAddress', 'Email Address') }}
        {{ Form::text('email', old('email'), ['id' => 'emailAddress', 'class' => 'form-control', 'placeholder' => 'Email address here...', 'required' => '']) }}
    </div>

    <div class="form-group col-md-12">
        {{ Form::label('address', 'Address') }}
        {{ Form::textarea('address', old('address'), ['id' => 'address', 'class' => 'form-control', 'placeholder' => 'Address here...', 'rows' => '2', 'required' => '']) }}
    </div>

    <div class="form-group col-md-4">
        <div class="form-check col-md-4">
            <input type="checkbox" name="status" id="status" class="form-check-input" 
                @isset($location)
                {{ $location->status ? 'checked="checked"' : '' }}
                @else
                {{ 'checked="checked"' }}
                @endisset
            >
            <label for="status">Active</label>
        </div>
    </div>

</div>