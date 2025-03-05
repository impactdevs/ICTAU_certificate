@extends('layouts.user_type.auth')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-primary text-light">Members</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/member/create') }}" class="btn btn-primary btn-sm" title="Add New member">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/admin/member') }}" accept-charset="UTF-8"
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
                            <table class="table table-bordered" data-toggle="table" data-pagination="true"
                                data-page-list="[5, 25, 50, 100, all]" data-search="true">
                                <thead>
                                    <tr>
                                        <th>Membership ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Membership Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($member as $item)
                                        <tr>
                                            <td>{{ $item->membership_id }}</td>
                                            <td>{{ $item->first_name }}</td>
                                            <td>{{ $item->last_name }}</td>
                                            <td>{{ $item->membershipType->membership_type_name }}</td>
                                            <td>
                                                <a href="{{ url('/admin/member/' . $item->id) }}"
                                                    title="View member"><button class="btn btn-success"><i class="fa fa-eye"
                                                            aria-hidden="true"></i> View</button></a>
                                                <a href="{{ url('/admin/member/' . $item->id . '/edit') }}"
                                                    title="Edit member"><button class="btn btn-warning"><i
                                                            class="fa fa-pencil" aria-hidden="true"></i>
                                                        Edit</button></a>

                                                <form method="POST" action="{{ url('/admin/member' . '/' . $item->id) }}"
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
                                                                    href="{{ url('/get-certificate?id=' . $item->id . '&file_type=png') }}">PNG</a></button>
                                                        </li>
                                                        <li><button class="dropdown-item" type="button"><a
                                                                    class="dropdown-item"
                                                                    href="{{ url('/get-certificate?id=' . $item->id . '&file_type=pdf') }}">PDF</a></button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
