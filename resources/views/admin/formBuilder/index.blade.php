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
                        {{ session('success') }}
                    @endif
                    @if (session('error'))
                        {{ session('error') }}
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
                                        <form action="{{ url('admin/formBuilder') }}" method="post" >
                                        @csrf

                                        @include ('admin.formBuilder.create')
                                        
                                        </form>
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
                                            <a href="{{ url('/admin/formBuilder/' . $form->id) }}" title="View form">
                                                <button class="btn btn-success">
                                                    <i class="fa fa-eye" aria-hidden="true"></i> View
                                                </button>
                                            </a>
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
