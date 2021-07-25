<div class="form-row">
    {{ Form::token() }}
    <div class="form-group col-md-12">
        {{ Form::label('locationId', 'Location') }}
        {{ Form::select('location_id', $locations, old('location_id'), ['placeholder' => 'Select location...', 'id' => 'locationId', 'class' => 'form-control', 'required' => '']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('reason_of_return', 'Reason of Return') }}
        {{ Form::select('reason_of_return_id', $rors, old('reason_of_return_id'), ['placeholder' => 'Select here...', 'id' => 'reason_of_return', 'class' => 'form-control', 'required' => '']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('subject_for', 'Subject For') }}
        {{ Form::select('subject_for_id', $sfs, old('subject_for_id'), ['placeholder' => 'Select here...', 'id' => 'subject_for', 'class' => 'form-control', 'required' => '']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('dateReturnCreate', 'Date Return') }}
        {{ Form::date('date_received', old('date_received'), ['id' => 'dateReturnCreate', 'class' => 'form-control', 'placeholder' => 'Date here...', 'required' => '']) }}
    </div>
</div>