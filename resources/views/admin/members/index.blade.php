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

                        <div class="table-responsive">
                            <table class="table table-bordered" 
                                   data-toggle="table" 
                                   data-pagination="true" 
                                   data-page-list="[5, 25, 50, 100, all]" 
                                   data-search="true">
                                <thead>
                                    <tr>
                                        <th data-sortable="true">Membership ID</th>
                                        <th data-sortable="true">First Name</th>
                                        <th data-sortable="true">Last Name</th>
                                        <th data-sortable="true">Membership Type</th>
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
                                                <a href="{{ url('/admin/member/' . $item->id) }}" title="View member">
                                                    <button class="btn btn-success">
                                                        <i class="fa fa-eye" aria-hidden="true"></i> View
                                                    </button>
                                                </a>
                                                <a href="{{ url('/admin/member/' . $item->id . '/edit') }}" title="Edit member">
                                                    <button class="btn btn-warning">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                    </button>
                                                </a>

                                                <form method="POST" action="{{ url('/admin/member' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger" title="Delete member" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                    </button>
                                                </form>

                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Certificate
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ url('/get-certificate?id=' . $item->id . '&file_type=png') }}">PNG</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ url('/get-certificate?id=' . $item->id . '&file_type=pdf') }}">PDF</a>
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
