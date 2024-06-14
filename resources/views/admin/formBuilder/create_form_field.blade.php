

<div class="container mt-4">
    <div class="row">
        <div class="col-12 mb-3">
            {{ Form::label('question', __('Question Name'), ['class' => 'form-label']) }}
            {{ Form::text('question[]', '', ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="col-12 mb-3">
            {{ Form::label('type', __('Field Type'), ['class' => 'form-label']) }}
            {{ Form::select('fieldTypes[]', $fieldTypes, null, ['class' => 'form-control select2', 'id' => 'choices-multiple1', 'required' => 'required']) }}
        </div>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary btn-sm" id="btn-submit">Submit</button>
    </div>
</div>
