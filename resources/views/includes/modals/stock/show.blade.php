<!-- Modal -->
<div class="modal fade" id="modalShowStock{{ $stock->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="modalShowStock{{ $stock->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <strong>Check-in ID: </strong><span class="text-primary">{{ $stock->checkIn->ReferenceNo }}</span>&nbsp;<strong>Toner Model: </strong><span class="text-primary">{{ $stock->toner->model_name }}</span>
                <button type="button" class="close" data-dismiss="modal" data-target="#modalShowStock{{ $stock->id }}" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6><strong>Details</strong></h6>
                        <table class="table table-bordered table-sm">
                            <tbody>
                                <tr>
                                    <th>Check-in Stock</th>
                                    <td>{{ $stock->quantity }} PCS</td>
                                </tr>
                                <tr>
                                    <th>Total Release</th>
                                    <td>{{ $stock->ReleaseItemCompleted->sum('quantity') }} PCS</td>
                                </tr>
                                <tr>
                                    <th>Remaining Stock</th>
                                    <td>{{ $stock->quantity - $stock->ReleaseItemCompleted->sum('quantity') }} PCS</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <h6><strong>Distribution</strong></h6>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Check-out ID</th>
                                    <th>Quantity</th>
                                    <th>DR No.</th>
                                    <!-- <th>Toner Code</th> -->
                                    <th>Request Slip No.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($stock->ReleaseItemCompleted as $releaseItem)
                                <tr>
                                    <td><a href="{{ route('checkouts.show', $releaseItem->CheckOut->id) }}" class="text-primary">{{ $releaseItem->checkOut->ReferenceNo }}</a></td>
                                    <td>{{ $releaseItem->quantity }}</td>
                                    <td>{{ $releaseItem->checkOut->delivery->dr_no ?? 'N/A' }}</td>
                                    <!-- <td>{{ $releaseItem->checkOut->toner_code }}</td> -->
                                    <td>{{ $releaseItem->checkOut->request_slip_no }}</td>
                                </tr>  
                                @empty
                                    <tr>
                                        <td colspan="5">No record found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>