@extends('layouts.user_type.auth')

@section('content')
    <div class="container">
        <h1>Applicants</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Application ID</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Institution</th>
                    <th>Course</th>
                    <th>Company Name</th>
                    <th>Company Website</th>
                    <th>Niche</th>
                    <th>Date of Birth</th>
                    <th>Profession</th>
                    <th>Application Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applicants as $applicant)
                    <tr>
                        <td>{{ $applicant->application_id }}</td>
                        <td>{{ $applicant->phone_number }}</td>
                        <td>{{ $applicant->email }}</td>
                        <td>{{ $applicant->first_name }}</td>
                        <td>{{ $applicant->last_name }}</td>
                        <td>{{ $applicant->institution }}</td>
                        <td>{{ $applicant->course }}</td>
                        <td>{{ $applicant->company_name }}</td>
                        <td>{{ $applicant->company_website }}</td>
                        <td>{{ $applicant->niche }}</td>
                        <td>{{ $applicant->date_of_birth }}</td>
                        <td>{{ $applicant->profession }}</td>
                        <td>{{ $applicant->application_type }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- pagination --}}
        <div class="d-flex justify-content-center">
            {!! $applicants->links() !!}
        </div>
    </div>
@endsection
