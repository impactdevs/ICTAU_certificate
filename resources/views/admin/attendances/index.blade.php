@extends('layouts.user_type.auth')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-primary text-light">Attendence Management</div>
                    <div class="card-body">
                        <form method="GET" action="{{ url('/admin/attendance') }}" accept-charset="UTF-8"
                            class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..."
                                    value="{{ request('search') }}">
                                <span style="margin-left:5px">
                                    <button class="btn btn-primary" type="submit" style="height:34px">
                                        Search
                                    </button>
                                </span>
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
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendances as $attendance)
                                        <tr>
                                            <td>{{ $attendance->id }}</td>
                                            <td>{{ $attendance->first_name }}</td>
                                            <td>{{ $attendance->last_name }}</td>
                                            <td>{{ $attendance->email }}</td>
                                            <td>
                                                <a href="{{ url('/admin/member/' . $attendance->id) }}"
                                                    title="View member"><button class="btn btn-success"><i class="fa fa-eye"
                                                            aria-hidden="true"></i> View</button></a>
                                                <a href="{{ url('/admin/member/' . $attendance->id . '/edit') }}"
                                                    title="Edit member"><button class="btn btn-warning"><i
                                                            class="fa fa-pencil" aria-hidden="true"></i>
                                                        Edit</button></a>

                                                <form method="POST"
                                                    action="{{ url('/admin/member' . '/' . $attendance->id) }}"
                                                    accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger" title="Delete member"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                            class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                                </form>

                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Certificate
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><button class="dropdown-item" type="button"><a
                                                                    class="dropdown-item"
                                                                    href="{{ url('/get-attendance-certificate?id=' . $attendance->id . '&file_type=png') }}">PNG</a></button>
                                                        </li>
                                                        <li><button class="dropdown-item" type="button"><a
                                                                    class="dropdown-item"
                                                                    href="{{ url('/get-attendance-certificate?id=' . $attendance->id . '&file_type=pdf') }}">PDF</a></button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $attendances->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
