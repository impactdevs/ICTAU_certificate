@extends('layouts.user_type.auth')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">member {{ $member->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/member') }}" title="Back"><button class="button2"><i class="fa fa-arrow-left"
                                    aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/member/' . $member->id . '/edit') }}" title="Edit member"><button
                                class="button1"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/member' . '/' . $member->id) }}" accept-charset="UTF-8"
                            style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="button3" title="Delete member"
                                onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                    aria-hidden="true"></i> Delete</button>
                        </form>
                        <br />
                        <br />

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Membership ID</th>
                                        <td>{{ $member->membership_id }}</td>
                                    </tr>
                                    <tr>
                                        <th> First Name </th>
                                        <td> {{ $member->first_name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Last Name </th>
                                        <td> {{ $member->last_name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Phone Number </th>
                                        <td> {{ $member->phone }} </td>
                                    </tr>
                                    <tr>
                                        <th> Email </th>
                                        <td> {{ $member->email }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
