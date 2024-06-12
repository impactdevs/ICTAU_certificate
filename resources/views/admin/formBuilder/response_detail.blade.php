@extends('layouts.user_type.auth')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-primary text-light">
                    Response details
                    <div class="form float-end">
                        <a href="{{ url('/admin/formBuilder') }}" title="Form builder">
                            <button class="btn btn-success">
                                <i class="fa fa-eye" aria-hidden="true"></i> Back to home
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text">
                        @if($formFields)
                            @foreach($formFields as $field)
                            <div class="mb-3">
                                <p><strong>{{ $field->question }}</strong></p>
                                @foreach($responses as $que => $ans)
                                <p>{{ $que }}</p>
                                <li>{{ $ans }}</li>
                                @endforeach
                            </div>
                            @endforeach
                        @else
                            <p>No form fields found.</p>
                        @endif
                    </div>
                </div>
            </div>         
        </div>       
    </div>
</div>
@endsection

