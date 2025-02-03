@extends('layouts.user_type.auth')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-primary text-light">Add New Attendance</div>
                    <div class="card-body">
                        <!-- Back Button -->
                        <a href="{{ url('/admin/attendance') }}" title="Back">
                            <button class="btn btn-primary">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                            </button>
                        </a>
                        <br />
                        <br />

                        <!-- Attendance Form -->
                        <form method="POST" action="{{ url('/admin/attendance') }}" accept-charset="UTF-8" class="form-horizontal">
                            @csrf

                            @include ('admin.attendances.form', ['formMode' => 'create'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
