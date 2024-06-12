@extends('layouts.app')

@section('form_content')
<div class="container mt-5">
    <div class="content">       
    <div class="content-wrapper mt-5">
        <div class="row">
            <div class="col-sm-12">
             <div class="card">
                <div class="card-header bg-primary text-light">
                    <h3> Form : {{ $form->name }}

                    <div class="form float-end">
                        <a href="{{ url('/admin/formBuilder') }}" title="Form builder">
                            <button class="btn btn-success">
                                <i class="fa fa-eye" aria-hidden="true"></i> Back to home
                            </button>
                        </a>
                    </div>
                    </h3> 
                </div>
                    
                <div class="card-body">
            <div class="card shadow zindex-100 mb-0">
                {{ Form::open(['url' => 'admin/formBuilder/form/store_response/'.$form->id, 'method' => 'post']) }}
                <div class="card-body px-md-5 py-5">  
                    @if($formFields && $formFields->count() > 0)
                        @foreach($formFields as $objField)
                            @if($objField->type == 'text')
                                <div class="form-group">
                                    {{ Form::label('field-'.$objField->id, __($objField->question), ['class' => 'form-label']) }}
                                    {{ Form::text('field['.$objField->id.']', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'field-'.$objField->id]) }}
                                </div>
                            @elseif($objField->type == 'email')
                                <div class="form-group">
                                    {{ Form::label('field-'.$objField->id, __($objField->question), ['class' => 'form-label']) }}
                                    {{ Form::email('field['.$objField->id.']', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'field-'.$objField->id]) }}
                                </div>
                            @elseif($objField->type == 'number')
                                <div class="form-group">
                                    {{ Form::label('field-'.$objField->id, __($objField->question), ['class' => 'form-label']) }}
                                    {{ Form::number('field['.$objField->id.']', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'field-'.$objField->id]) }}
                                </div>
                            @elseif($objField->type == 'date')
                                <div class="form-group">
                                    {{ Form::label('field-'.$objField->id, __($objField->question), ['class' => 'form-label']) }}
                                    {{ Form::date('field['.$objField->id.']', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'field-'.$objField->id]) }}
                                </div>
                            @elseif($objField->type == 'textarea')
                                <div class="form-group">
                                    {{ Form::label('field-'.$objField->id, __($objField->question), ['class' => 'form-label']) }}
                                    {{ Form::textarea('field['.$objField->id.']', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'field-'.$objField->id]) }}
                                </div>
                            @endif
                        @endforeach
                    @endif
                    <div class="mb-3">
                    <button type="submit" class="btn btn-primary btn-sm" id="btn-submit">submit</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
    </div>
</div>
@endsection
