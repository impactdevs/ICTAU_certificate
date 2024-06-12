

<div class="form-group">

<div class="col-12 form-group">
    {{ Form::label('question', __('Question Name'),['class'=>'form-label']) }}
    {{ Form::text('question[]', '', array('class' => 'form-control','required'=>'required')) }}
</div>
<div class="col-12 form-group">
    {{ Form::label('type', __('Type'),['class'=>'form-label']) }}
    {{ Form::select('fieldTypes[]', $fieldTypes, array('class' => 'form-control select2','id'=>'choices-multiple1','required'=>'required')) }}
</div>
</div>
<div class="mb-3">
<button type="submit" class="btn btn-primary btn-sm" id="btn-submit">submit</button>
</div>
</form>
</div>

