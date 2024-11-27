@extends('layouts.user_type.auth')

@section('content')
    <div class="container">
        <h1>Applicants</h1>
        <table class="table table-bordered" data-toggle="table" data-pagination="true" data-page-list="[10, 25, 50, 100, all]" data-search="true" data-show-export="true">
            <thead>
                <tr>
                    <th>#</th> <!-- For the row number -->
                    <th>Application ID</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Company Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applicants as $index => $applicant)
                    <tr>
                        <td>{{ $index + 1 }}</td> <!-- Display row count (1, 2, 3, etc.) -->
                        <td>
                            <a href="{{ '/admin/applicants/' . $applicant->application_id }}"
                               class="
                                   @if ($applicant->application_status == 'pending') link-warning
                                   @elseif ($applicant->application_status == 'reject') link-danger
                                   @elseif ($applicant->application_status == 'approve') link-success @endif
                               ">
                                {{ $applicant->application_id }}
                            </a>
                        </td>
                        <td>{{ $applicant->phone_number }}</td>
                        <td>{{ $applicant->email }}</td>
                        <td>{{ $applicant->first_name }}</td>
                        <td>{{ $applicant->last_name }}</td>
                        <td>{{ $applicant->company_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
