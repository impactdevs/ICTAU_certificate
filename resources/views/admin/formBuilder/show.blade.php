@extends('layouts.user_type.auth')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-primary text-light">Form : {{ $form->name }}</div>
                <div class="card-body">
                    <div class="message">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>

                    <button class="btn btn-primary btn-sm mb-3" type="button" id="ajaxform">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add form field
                    </button>
                    <div class="form float-end">
                        <a href="{{ url('/admin/formBuilder/form/' . $form->id) }}" title="View form">
                            <button class="btn btn-success">
                                <i class="fa fa-eye" aria-hidden="true"></i> View form
                            </button>
                        </a>
                    </div>
                    <div class="create-form mb-3" id="createForm">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 form-group">
                                    <h3>Question Fields</h3>
                                    <form action="{{ url('admin/formBuilder/create_form_field/'. $form->id ) }}" method="post">
                                        @csrf
                                        @include('admin.formBuilder.create_form_field')
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                 

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">Form Question</th>
                                    <th class="text-center">Form Type</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($form->formFields->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">There is no data in the database.</td>
                            </tr>
                            @else
                            @foreach($form->formFields as $field)
                                    <tr>
                                        <td class="text-center">{{ $field->question }}</td>
                                        <td class="text-center">{{$field->type }}</td>
                                        
                                        <td class="text-center">
                                           
                                            <a href="{{ url('/admin/formBuilder/' . $form->id . '/edit') }}" title="Edit form">
                                                <button class="btn btn-warning">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                </button>
                                            </a>
                                            <form method="POST" action="{{ url('/admin/formBuilder/' . $form->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger" title="Delete form" onclick="return confirm('Confirm delete?')">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach 
                                @endif
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
