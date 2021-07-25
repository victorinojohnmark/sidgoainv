{{ Form::token() }}
<div class="form-row">
  <div class="form-group col-md-12">
    {{ Form::label('location', 'Location') }}
    {{ Form::select('location_id', $locations, old('location_id'), ['placeholder' => 'Select location here...', 'id' => 'location', 'class' => 'form-control', 'required' => '']) }}
  </div>
  <div class="form-group col-md-6">
    {{ Form::label('off_the_record_transaction_type', 'Transaction Type') }}
    {{ Form::select('off_the_record_transaction_type_id', $transaction_types, old('off_the_record_transaction_type_id'), ['placeholder' => 'Select here...', 'id' => 'off_the_record_transaction_type', 'class' => 'form-control', 'required' => '']) }}
  </div>
  <div class="form-group col-md-6">
    {{ Form::label('transaction_date', 'Transaction Date') }}
    {{ Form::date('transaction_date', old('transaction_date'), ['id' => 'transaction_date', 'class' => 'form-control', 'placeholder' => 'Select date here...', 'required' => '']) }}
  </div>
  <div class="form-group col-md-12">
    {{ Form::label('transaction_reference', 'Transaction Reference') }}
    {{ Form::text('transaction_reference', old('transaction_reference'), ['id' => 'transaction_reference', 'class' => 'form-control', 'placeholder' => 'Transaction ref. here...', 'required' => '']) }}
  </div>
  <div class="form-group col-md-6">
    {{ Form::label('off_the_record_issue_description', 'Issue Description') }}
    {{ Form::select('off_the_record_issue_description_id', $issue_descriptions, old('off_the_record_issue_description_id'), ['placeholder' => 'Select here...', 'id' => 'off_the_record_issue_description', 'class' => 'form-control', 'required' => '']) }}
  </div>
  <div class="form-group col-md-6">
    {{ Form::label('off_the_record_subject_for', 'Subject For') }}
    {{ Form::select('off_the_record_subject_for_id', $subject_fors, old('off_the_record_subject_for_id'), ['placeholder' => 'Select here...', 'id' => 'off_the_record_subject_for', 'class' => 'form-control', 'required' => '']) }}
  </div>
  <div class="form-group col-md-6">
    {{ Form::label('off_the_record_action_taken', 'Action Taken') }}
    {{ Form::select('off_the_record_action_taken_id', $action_takens, old('off_the_record_action_taken_id'), ['placeholder' => 'Select here...', 'id' => 'off_the_record_action_taken', 'class' => 'form-control', 'required' => '']) }}
  </div>
  <div class="form-group col-md-6">
    {{ Form::label('action_reference', 'Action Reference') }}
    {{ Form::text('action_reference', old('action_reference'), ['id' => 'action_reference', 'class' => 'form-control', 'placeholder' => 'Action ref. here...', 'required' => '']) }}
  </div>
  <div class="form-group col-md-12">
    {{ Form::label('notes', 'Notes') }}
    {{ Form::textarea('notes', old('notes'), ['id' => 'notes', 'class' => 'form-control', 'placeholder' => 'Note here...', 'rows' => '2']) }}
</div>
</div>