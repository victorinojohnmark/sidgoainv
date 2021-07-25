<!-- Modal -->
<div class="modal fade" id="modalAddReturnItem{{ $releaseItem->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="modalAddReturnItem{{ $releaseItem->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddReturnItem{{ $releaseItem->id }}Label">{{ $releaseItem->stock->toner->model_name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => 'returnItem.store', 'method' => 'post']) !!}
                <div class="modal-body">
                    {{ Form::hidden('return_receive_id', $returnReceive->id) }}
                    {{ Form::hidden('release_item_id', $releaseItem->id) }}
                    
                    {{ Form::label('quantity', 'Quantity') }}
                    {{ Form::number('quantity', old('quantity'), ['id' => 'quantity', 'min' => '1', 'class' => 'form-control', 'placeholder' => 'Quantity here...', 'required' => '']) }}
                    
                </div> <!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add Return Item</button>
                    <button type="reset" class="btn btn-sm btn-danger"><i class="fas fa-times"></i> Reset</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>