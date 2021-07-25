<!-- Modal -->
<div class="modal fade" id="modalConfirmVoidCheckout" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="modalConfirmVoidCheckoutLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalConfirmVoidCheckoutLabel">Are you sure you want to void this checkout?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            {!! Form::open(['url' => '/checkouts/void/'.$checkout->id, 'method' => 'PATCH']) !!}
            {{ Form::token() }}
            {{-- {{ Form::hidden('set_complete', 1, ['required' => '']) }} --}}
            <div class="modal-body">
                <p>Please confirm to complete.</p>
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

                @if (!is_null($checkout->parentCheckout))
                <p>
                    <i class="fas fa-info-circle text-primary"></i> Checkout with reference no <b><a href="{{ route('checkouts.show', $checkout->parentCheckout->id) }}" target="_blank">{{ $checkout->parentCheckout->reference_no }}</a></b> will be unlink in this checkout after voiding.
                </p>
                @endif

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-primary">Confirm</button>
            </div>
            
            {!! Form::close() !!}
            
        </div>
    </div>
</div>