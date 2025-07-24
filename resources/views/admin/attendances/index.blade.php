@extends('layouts.user_type.auth')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-primary text-light">Attendance Management</div>
                    <div class="card-body">
                        <form method="GET" action="{{ url('/admin/attendance') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <select name="event_id" class="form-control" style="margin-right: 5px;">
                                    <option value="">-- Filter by Event --</option>
                                    @foreach($events as $event)
                                        <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>
                                            {{ $event->name }} ({{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }})
                                        </option>
                                    @endforeach
                                </select>
                                <input type="text" class="form-control" name="search" placeholder="Search name or email..." value="{{ request('search') }}" style="margin-right: 5px;">
                                <button class="btn btn-primary" type="submit" style="height:34px">
                                    <i class="fa fa-search"></i> Search
                                </button>
                                @if(request('event_id') || request('search'))
                                    <a href="{{ url('/admin/attendance') }}" class="btn btn-secondary" style="height:34px; margin-left:5px;">
                                        <i class="fa fa-refresh"></i> Reset
                                    </a>
                                @endif
                            </div>
                        </form>

                        <br />
                        <br />
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Event</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($attendances as $attendance)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $attendance->first_name }}</td>
                                            <td>{{ $attendance->last_name }}</td>
                                            <td>{{ $attendance->email }}</td>
                                            <td>
                                                @if($attendance->event)
                                                    {{ $attendance->event->topic }} ({{ \Carbon\Carbon::parse($attendance->event->event_date)->format('M d, Y') }})
                                                @else
                                                    <span class="text-danger">No event assigned</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('/admin/member/' . $attendance->id) }}"
                                                    title="View member" class="btn btn-success btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ url('/admin/member/' . $attendance->id . '/edit') }}"
                                                    title="Edit member" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>

                                                <form method="POST"
                                                    action="{{ url('/admin/member' . '/' . $attendance->id) }}"
                                                    accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete member"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </form>

                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-certificate"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item"
                                                            href="{{ url('/get-attendance-certificate?id=' . $attendance->id . '&file_type=png') }}">PNG</a></li>
                                                        <li><a class="dropdown-item"
                                                            href="{{ url('/get-attendance-certificate?id=' . $attendance->id . '&file_type=pdf') }}">PDF</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No attendance records found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="pagination-wrapper">
                                {!! $attendances->appends(request()->except('page'))->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection