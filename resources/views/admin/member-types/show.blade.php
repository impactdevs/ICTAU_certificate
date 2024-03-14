@extends('layouts.user_type.auth')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">member_type {{ $member_type->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/member_type') }}" title="Back"><button class="button2"><i
                                    class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/member_type/' . $member_type->id . '/edit') }}"
                            title="Edit member_type"><button class="button1"><i class="fa fa-pencil-square-o"
                                    aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/member_type' . '/' . $member_type->id) }}"
                            accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="button3" title="Delete member_type"
                                onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                    aria-hidden="true"></i> Delete</button>
                        </form>
                        <br />
                        <br />

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>User Code</th>
                                        <td>{{ $member_type->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> First Name </th>
                                        <td> {{ $member_type->membership_type_name }} </td>
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
