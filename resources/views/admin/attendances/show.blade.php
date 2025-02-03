@extends('layouts.user_type.auth')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h4>Attendance #{{ $attendance->id }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <a href="{{ url('/admin/attendance') }}" class="btn btn-secondary" title="Back">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                            </a>
                            <div>
                                <a href="{{ url('/admin/attendance/' . $attendance->id . '/edit') }}" class="btn btn-warning" title="Edit Attendance">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                </a>
                                <form method="POST" action="{{ url('admin/attendance/' . $attendance->id) }}" accept-charset="UTF-8" style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger" title="Delete Attendance" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">First Name</h5>
                                        <p class="card-text">{{ $attendance->first_name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Last Name</h5>
                                        <p class="card-text">{{ $attendance->last_name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Email</h5>
                                        <p class="card-text">{{ $attendance->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
