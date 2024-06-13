@extends('layouts.user_type.auth')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-primary text-light">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="m-0">{{ $formBuilder->name }}</h3>
                        <br>
                        <h6> Form Details </h6>
                    </div>
                    <div class="col-auto">
                        <a href="{{ url('/admin/formBuilder') }}" class="btn btn-success">
                            <i class="fa fa-eye" aria-hidden="true"></i> Back to Home
                        </a>
                    </div>
                </div>
                </div>
                <div class="card-body">
                    <div class="text">
                        @if($responses)   
                        <div>     
                        </div>       
                            <div class="mb-3">
                                @foreach($data as $response)            
                                <p><strong>{{ $response['question']}}</strong></p>
                                <li>{{ $response['response'] }}</li>
                                <hr>
                                @endforeach
                            </div>
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

