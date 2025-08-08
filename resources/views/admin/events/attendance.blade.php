@extends('layouts.user_type.auth')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-primary text-light">
                    Attendance for: {{ $event->topic }} ({{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }})
                </div>
                <div class="card-body">
                    <a href="{{ url('/admin/events') }}" class="btn btn-secondary btn-sm mb-3">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Events
                    </a>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>last Name</th>
                                    <th>Email</th>
                                    <th>Certificate</th>
                                    <th>Registered At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendances as $attendance)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $attendance->first_name ?? 'N/A' }}</td>
                                    <td>{{ $attendance->last_name ?? 'N/A' }}</td>
                                    <td>{{ $attendance->email ?? 'N/A' }}</td>
                                    <td>
                                               <div class="btn-group">
                                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-certificate"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item"
                                                            href="{{ url('/get-attendance-certificate?id=' . $attendance->id . '&file_type=png&event_id=' . $event->event_id) }}">PNG</a></li>
                                                        <li><a class="dropdown-item"
                                                            href="{{ url('/get-attendance-certificate?id=' . $attendance->id . '&file_type=pdf&event_id=' . $event->event_id) }}">PDF</a></li>
                                                    </ul>
                                                </div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($attendance->created_at)->format('M j, Y g:i A') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper">
                            {{ $attendances->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection