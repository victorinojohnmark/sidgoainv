<!-- Modal -->
<div class="modal fade" id="modaDeleteReturnReceive{{ $returnReceive->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="modaDeleteReturnReceive{{ $returnReceive->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaDeleteReturnReceive{{ $returnReceive->id }}Label">Delete return</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => ['returnReceive.destroy', $returnReceive->id], 'method' => 'DELETE']) !!}
                {{ Form::token() }}
                <div class="modal-body">
                    <p><strong>Are you sure you want to delete?</strong></p>
                    <table class="table table-sm table-stripe table-bordered">
                        <tbody>
                            <tr>
                                <th style="width:150px;">Location</th>
                                <td>{{ $returnReceive->location->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Date Received</th>
                                <td>{{ $returnReceive->date_received }}</td>
                            </tr>
                            <tr>
                                <th>Reason of return</th>
                                <td>{{$returnReceive->reasonOfReturn->value}}</td>
                            </tr>
                            <tr>
                                <th>Subject For</th>
                                <td>{{$returnReceive->subjectFor->value}}</td>
                            </tr>
                        </tbody>
                    </table>

                    <h4 class="mt-3"><strong>Items</strong></h4>
                    <table class="table table-sm table-stripe table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Checkout Reference</th>
                                <th>Toner Model</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($returnReceive->returnItems as $item)
                            <tr>
                                <td>{{$item->releaseItem->checkOut->reference_no}}</td>
                                <td>{{$item->releaseItem->stock->toner->model_name}}</td>
                                <td>{{$item->quantity}}</td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No record/s to show.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    
                </div> <!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Confirm Delete</button>
                    <button type="button" data-dismiss="modal" class="btn btn-sm btn-primary"><i class="fas fa-times"></i> Close</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>