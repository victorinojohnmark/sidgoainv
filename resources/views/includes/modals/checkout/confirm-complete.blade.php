<!-- Modal -->
<div class="modal fade" id="modalconfirmCompleted" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="modalconfirmCompletedLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalconfirmCompletedLabel">Set as completed?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            {!! Form::model($checkout, ['url' => '/checkouts/set_completed/'.$checkout->id, 'method' => 'patch']) !!}
            {{ Form::token() }}
            {{-- {{ Form::hidden('set_complete', 1, ['required' => '']) }} --}}
            <div class="modal-body">
                Please confirm to complete.
                <table class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Toner</th>
                            <th>Type</th>
                            <th>Total QTY.</th>
                            <th>Units</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($totalReleases->sortBy('id') as $totalRelease)
                        <tr>
                            <td>{{ $totalRelease->stock->toner->model_name }}</td>
                            <td>{{ $totalRelease->stock->toner->toner_type->name }}</td>
                            <td>{{ $totalRelease->total_count }}</td>
                            <td>{{ $totalRelease->stock->toner->unit->name }}</td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="4">No record found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {{ Form::label('invoice_no', 'Sales Invoice') }}
                        {{ Form::text('invoice_no', old('invoice_no'), ['placeholder' => 'Sales Invoice no here...', 'id' => 'invoice_no', 'class' => 'form-control', 'required' => '']) }}
                    </div>
                    <div class="form-group col-md-6">
                        {{-- {{ $disabled = $checkout->parent_checkout_id ? 'disabled' : '' }} --}}
                        {{ Form::label('deliveryStatus', 'Delivery Status') }}
                        {{ Form::select('delivery_status_id', $delivery_statuses, old('delivery_status_id'), ['placeholder' => 'Select delivery status...', 'id' => 'deliveryStatus', 'class' => 'form-control', 'required' => '', $checkout->parent_checkout_id ? 'disabled' : '']) }}
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('delivery_by', 'Delivery By') }}
                        {{ Form::text('delivery_by', old('delivery_by'), ['placeholder' => 'Delivery by', 'id' => 'delivery_by', 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('delivery_date', 'Delivery Date') }}
                        {{ Form::date('delivery_date', old('delivery_date'), ['placeholder' => 'Delivery date here...', 'id' => 'delivery_date', 'class' => 'form-control', 'required' => '']) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-primary">Confirm</button>
            </div>
            
            {!! Form::close() !!}
            
        </div>
    </div>
</div>