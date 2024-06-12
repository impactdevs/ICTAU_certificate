@extends('layouts.user_type.auth')

@section('content')
<div class="container mt-5">
    <div class="content">       
    <div class="content-wrapper mt-5">
        <div class="row">
            <div class="col-sm-12">
             <div class="card">
                <div class="card-header bg-primary text-light">
                    <h3> Edit : {{ $form->name }}

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
                    <form action="{{ url('admin/formBuilder/update/'. $form->id ) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Form Name</label>
                            <input type="text" name="name" value="{{ $form->name }}" class="form-control" id="name">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary btn-sm" id="btn-submit">Submit Update</button>
                        </div>
                    </form>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection
