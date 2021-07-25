<!-- Modal -->
<div class="modal fade" id="modalUploadFileCheckout{{ $checkout->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="modalUploadFileCheckoutLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUploadFileCheckoutLabel">{{ $checkout->reference_no }} - File Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['url' => '/checkouts/'.$checkout->id.'/upload', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                <div class="modal-body">
                    
                    @include('includes.forms.checkout-fileupload')
                    <hr>
                    <h4>Files uploaded</h4>
                    <ul class="pt-3">
                        @if (count($checkout->files))
                            @foreach ($checkout->files as $file)
                            {{-- <li b><a href="/uploads/{{ $file }}" target="_blank">{{ $file }}</a>&nbsp;&nbsp;<a href="/checkouts/{{ $checkout->id }}/upload-delete?file={{ $file }}" class="text-danger">Delete</a></li> --}}
                            <li><a href="{{ Storage::url('uploads/'.$file) }}" target="_blank">{{ $file }}</a>&nbsp;&nbsp;<a href="/checkouts/{{ $checkout->id }}/upload-delete?file={{ $file }}" class="text-danger">Delete</a></li>
                            @endforeach
                        @else
                            <li>{{ 'No file uploaded.' }}</li>
                        @endif
                    </ul>
                    
                </div> <!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
                    <button type="reset" class="btn btn-sm btn-danger"><i class="fas fa-times"></i> Reset</button>
                </div>
            {!! Form::close() !!}
            
        </div>
    </div>
</div>