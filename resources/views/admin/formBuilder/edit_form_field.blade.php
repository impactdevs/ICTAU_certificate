<!-- edit form Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">                                      
                    <div class="form-group">
                     
                    <form action="{{ url('admin/formBuilder/update_form_field/'. $form->id ) }}" method="post" >
                    @csrf
                    @method('PUT')
                   
                    <div class="col-12 form-group">
                    {{ Form::label('question[]', __('Question'), ['class' => 'form-label']) }}
                    {{ Form::text('question[]', $types->question, ['class' => 'form-control', 'required' => 'required']) }}
                    </div>
                    <div class="col-12 form-group">
                    {{ Form::label('type', __('Type'), ['class' => 'form-label']) }}
                    {{ Form::select('type[]', $types->type, ['number' => 'Number', 'text' => 'Text', 'date' => 'Date'], ['class' => 'form-control select2','id'=>'choices-multiple1','required'=>'required']) }}
                    </div>
                    <div class="mb-3">
                    <button type="submit" class="btn btn-primary btn-sm" id="btn-submit">submit update</button>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>