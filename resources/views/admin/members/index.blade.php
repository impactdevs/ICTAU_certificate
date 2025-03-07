@extends('layouts.user_type.auth')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-primary text-light d-flex flex-row justify-content-between">
                        <p>Members</p>
                        <a href="{{ url('/admin/member/create') }}" class="btn btn-primary btn-sm" title="Add New member">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                    </div>
                    <div class="card-body" style="max-height: 73vh; overflow-y: auto;">
                        <table class="table table-bordered table-striped table-sm" data-toggle="table"
                            data-pagination="true" data-page-list="[5, 25, 50, 100, all]" data-search="true">
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
                                        <td class="{{ $item->applicant_id ? 'text-success' : '' }}"> <a
                                                href="{{ url('/admin/member/' . $item->id) }}" title="View member"
                                                class="{{ $item->applicant_id ? 'text-success' : '' }}">
                                                {{ $item->membership_id }}
                                            </a></td>
                                        <td>{{ $item->first_name }}</td>
                                        <td>{{ $item->last_name }}</td>
                                        <td>{{ $item->membershipType->membership_type_name }}</td>
                                        <td>
                                            <a href="{{ url('/admin/member/' . $item->id) }}" title="View member"><button
                                                    class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i>
                                                    View</button></a>
                                            <a href="{{ url('/admin/member/' . $item->id . '/edit') }}"
                                                title="Edit member"><button class="btn btn-warning"><i class="fa fa-pencil"
                                                        aria-hidden="true"></i>
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
                                            <!-- Toast Trigger Button -->
                                            <button type="button" class="btn btn-primary" id="toastbtn">Show
                                                Toast</button>

                                            <div class="toast">
                                                <div class="toast-header">
                                                    <strong class="me-auto">Toast Header</strong>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="toast"></button>
                                                </div>
                                                <div class="toast-body">
                                                    <p>Some text inside the toast body</p>
                                                </div>
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
@endsection
