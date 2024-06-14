@extends('layouts.app')

@section('form_content')
<div class="container mt-5">
    <div class="content">       
    <div class="content-wrapper mt-5">
        <div class="row">
            <div class="col-sm-12">
             <div class="card">
                
                </div>    
                    <div class="alert" >
                        <div class="alert alert-info d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Info:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <div>
                                Thank you 
                            </div>
                        </div>
                        <p>Thank you for successfully resgistering for your attendance to the ICTAU event.</p>
                        <hr>
                        <p class="mb-0">Continue  to the ICTAU website  
                            <span>
                            <a class="align-items-center" href="https://ictau.ug/">
                                <img src="{{asset('assets/img/ictau-logo.jpg')}}" class="navbar-brand-img h-100" alt="...">
                                {{-- <span class="ms-3 font-weight-bold">ICTA UGANDA</span> --}}
                            </a>
                            </span>
                        </p>
                    </div>
                </div>
        </div>
    </div>
</div>
    </div>
</div>
@endsection
