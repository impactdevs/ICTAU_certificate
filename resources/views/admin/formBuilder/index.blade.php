@extends('layouts.user_type.auth')

@section('content')
<div class="content-wrapper">
    <div class="row">
      <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-primary text-light">Form Builder</div>
                <div class="card-body">
                   <br>
                   <div class="message">
                    @if (session('success'))
                    <div class="alert alert-success" id="trigger">
                        {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger" id="trigger">
                        {{ session('error') }}
                        </div>
                    @endif
                    
                   </div>
                    <button class="btn btn-primary btn-sm" type="button" id="ajaxform">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </button>
                   <br>
                   <div class="create-form" id="createForm" >   
                    <div class="modal-body">             
                    <div class="row">
                        <div class="col-12 form-group">
                            <h3>Add new form</h3>
                            <div class="form">
                                <form action="{{ url('admin/formBuilder/create_form/') }}" method="post">
                                    @csrf

                                    @php
                                        use Illuminate\Support\Facades\Route;
                                    @endphp

                                    @if(Route::currentRouteName() == 'form_builder')
                                        @include('admin.formBuilder.create')
                                    @elseif(Route::currentRouteName() == 'form_builder_edit_form')
                                        @include('admin.formBuilder.edit')
                                    @endif
                                  
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                    <br>
                    <div class="create-form" id="editForm" >   
                    <div class="modal-body">             
                    <div class="row">
                        <div class="col-12 form-group">
                            <h3>Edit form</h3>
                            <div class="form">
                            
                                    @if(Route::currentRouteName() == 'form_builder')
                                    @include('admin.formBuilder.edit')
                                    
                                    @endif
                                  
                             
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                    <br>
                   
                    <div class="table-responsive">
                    <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">Form ID</th>
                                    <th class="text-center">Form Name</th>
                                    <th class="text-center">Form Response</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($forms as $form)
                                    <tr>
                                        <td class="text-center">{{ $form->id }}</td>
                                        <td class="text-center">{{ $form->name }}</td>
                                        <td class="text-center">{{ $form->response->count() }}</td>
                                        
                                        <td class="text-center">
                                            <a href="{{ url('/admin/formBuilder/form/' . $form->id) }}" title="View form">
                                                <button class="btn btn-success">
                                                    <i class="fa fa-eye" aria-hidden="true"></i> View
                                                </button>
                                            </a>
                                            <a href="{{ url('/admin/formBuilder/edit/' . $form->id) }}" title="Edit form" >
                                                <button class="btn btn-warning" id="ajaxeditForm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                </button>
                                            </a>
                                            <form method="POST" action="{{ url('admin/formBuilder/delete/' .  $form->id) }}" accept-charset="UTF-8" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Delete form" onclick="return confirm('Confirm delete?')">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">There is no data in the database.</td>
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
</div>
@endsection
