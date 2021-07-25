<!-- Modal -->
<div class="modal fade" id="modalShowToner{{ $toner->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="modalShowToner{{ $toner->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="modalShowToner{{ $toner->id }}Title">Add Toner</h5> --}}
                <strong>Toner Model:&nbsp;</strong><span class="text-primary">{{ $toner->model_name }}</span>
                <button type="button" class="close" data-dismiss="modal" data-target="#modalShowToner{{ $toner->id }}" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <table class="table table-bordered table-sm">
                            <tbody>
                                <tr>
                                    <th>Total</th>
                                    <td>{{ $toner->CurrentStock }} Pc/s</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <h5 class="mb-2">Stock(s) Reference</h5>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Check-in Reference # ID</th>
                                    <th>Stock #</th>
                                    <th>Quantity</th>
                                    <th>Remaining</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($toner->StocksCompleted as $stock)
                                    
                                    @if ($stock->RemainingStock)
                                        <tr>
                                            <td><a href="{{ route('checkins.show', $stock->checkIn->id) }}" target="_blank">{{ $stock->checkIn->ReferenceNo }}</a></td>
                                            <td>
                                                <a href="#" data-target="#modalShowStock{{ $stock->id }}" data-toggle="modal" class="text-primary">{{ $stock->toner->model_name }}</a>
                                                @include('includes.modals.stock.show')
                                            </td>
                                            <td>{{ $stock->quantity }}</td>
                                            <td>{{ $stock->RemainingStock }}</td>
                                        </tr>
                                    @endif
                                    
                                @empty
                                <tr><td colspan="4">No results.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>