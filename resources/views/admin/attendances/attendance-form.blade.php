@extends('layouts.user_type.auth')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h4>Attendance Form for Event: {{ $event->name }}</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <a href="{{ url('/admin/attendance/' . $event->id) }}" class="btn btn-secondary" title="Back">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                        </a>
                        <div>
                            <!-- Button to generate QR code -->
                            <a href="{{ $attendanceFormUrl }}" target="_blank" class="btn btn-success" title="Generate QR Code">
                                <i class="fa fa-qrcode" aria-hidden="true"></i> Generate QR Code
                            </a>
                        </div>
                    </div>

                    <!-- Display the attendance registration form -->
                    <form method="POST" action="{{ route('attendance.register', $event->id) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" id="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control" id="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Register Attendance</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
