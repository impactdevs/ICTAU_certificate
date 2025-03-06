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
                                class="button1"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/member' . '/' . $member->id) }}" accept-charset="UTF-8"
                            style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="button3" title="Delete member"
                                onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash"
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

                        {{-- bio information --}}

                        @if ($member->applicant)
                            @if ($member->applicant->application_type == 'company')
                                <div class="container mt-5">
                                    <div class="row justify-content-center">
                                        <div class="col-md-10">
                                            <div class="card shadow">
                                                <div class="card-header bg-primary text-white">
                                                    <h4 class="text-white">BIO-DATA</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row mb-4">
                                                        <div class="col-md-6">
                                                            <h5 class="text-secondary">Company Details</h5>
                                                            <p><strong>Company Name:</strong>
                                                                {{ $member->applicant->company_name }}</p>
                                                            <p><strong>Company Website:</strong>
                                                                {{ $member->applicant->company_website }}</p>
                                                            <p><strong>Niche:</strong> {{ $member->applicant->niche }}</p>
                                                            <p><strong>Phone Number:</strong>
                                                                {{ $member->applicant->phone_number }}</p>
                                                            <p><strong>Email:</strong> {{ $member->applicant->email }}</p>
                                                            <div class="mb-3">
                                                                <label><strong>Company Logo:</strong></label>
                                                                @if (filled($member->applicant->companyLogo))
                                                                    <div>
                                                                        <img src="{{ asset($member->applicant->companyLogo->logo) }}"
                                                                            alt="Company Logo" class="img-fluid"
                                                                            style="width: 250px; height: 250px;">
                                                                    </div>
                                                                @else
                                                                    <p>No company logo uploaded</p>
                                                                @endif
                                                            </div>
                                                            <div class="mb-3">
                                                                <label><strong>Payment Proof:</strong></label>
                                                                @if (filled($member->applicant->paymentProof))
                                                                    <div>
                                                                        <img src="{{ asset($member->applicant->paymentProof->payment_proof) }}"
                                                                            alt="Payment Proof" class="img-fluid"
                                                                            style="width: 250px; height: 250px;">
                                                                    </div>
                                                                @else
                                                                    <p>No payment proof uploaded</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h5 class="text-secondary">Contact People</h5>
                                                            @foreach ($member->applicant->contactPersons as $contactPerson)
                                                                <p><strong>First Name:</strong>
                                                                    {{ $contactPerson->first_name }}</p>
                                                                <p><strong>Last Name:</strong>
                                                                    {{ $contactPerson->last_name }}</p>
                                                                <p><strong>Phone Number:</strong>
                                                                    {{ $contactPerson->phone_number }}</p>
                                                                <p><strong>Email:</strong> {{ $contactPerson->email }}</p>
                                                                <hr>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($member->applicant->application_type == 'student')
                                <div class="mt-5">
                                    <div class="row justify-content-center">
                                        <div class="col-md-10">
                                            <div class="card shadow">
                                                <div class="card-header bg-primary text-white">
                                                    <h4 class="text-white">BIO-DATA</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row mb-4">
                                                        <div class="col-md-6">
                                                            <h5 class="text-secondary">Student Details</h5>
                                                            <p><strong>First Name:</strong>
                                                                {{ $member->applicant->first_name }}</p>
                                                            <p><strong>Last Name:</strong>
                                                                {{ $member->applicant->last_name }}</p>
                                                            <p><strong>Phone Number:</strong>
                                                                {{ $member->applicant->phone_number }}</p>
                                                            <p><strong>Email:</strong> {{ $member->applicant->email }}</p>
                                                            <p><strong>Institution: </strong>
                                                                {{ $member->applicant->institution }}</p>
                                                            <p><strong>Course:</strong> {{ $member->applicant->course }}
                                                            </p>
                                                            <p><strong>Date of Birth:</strong>
                                                                {{ $member->applicant->date_of_birth }}</p>
                                                            <div class="mb-3">
                                                                <label><strong>Student ID:</strong></label>
                                                                @if (filled($member->applicant->studentId))
                                                                    <div>
                                                                        <img src="{{ asset($member->applicant->studentId->student_id) }}"
                                                                            alt="Student ID" class="img-fluid"
                                                                            style="width: 250px; height: 250px;">
                                                                    </div>
                                                                @else
                                                                    <p>No student ID uploaded</p>
                                                                @endif
                                                            </div>
                                                            <div class="mb-3">
                                                                <label><strong>Passport Photo:</strong></label>
                                                                @if (filled($member->applicant->passportPhoto))
                                                                    <div>
                                                                        <img src="{{ asset($member->applicant->passportPhoto->passport_photo) }}"
                                                                            alt="Passport Photo" class="img-fluid"
                                                                            style="width: 250px; height: 250px;">
                                                                    </div>
                                                                @else
                                                                    <p>No passport photo uploaded</p>
                                                                @endif
                                                            </div>
                                                            <div class="mb-3">
                                                                <label><strong>Payment Proof:</strong></label>
                                                                @if (filled($member->applicant->paymentProof))
                                                                    <div>
                                                                        <img src="{{ asset($member->applicant->paymentProof->payment_proof) }}"
                                                                            alt="Payment Proof" class="img-fluid"
                                                                            style="width: 250px; height: 250px;">
                                                                    </div>
                                                                @else
                                                                    <p>No payment proof uploaded</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($member->applicant->application_type == 'professional')
                                <div class="container mt-5">
                                    <div class="row justify-content-center">
                                        <div class="col-md-10">
                                            <div class="card shadow">
                                                <div class="card-header bg-primary text-white">
                                                    <h4 class="text-white">BIO-DATA</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row mb-4">
                                                        <div class="col-md-6">
                                                            <h5 class="text-secondary">Professional Details</h5>
                                                            <p><strong>First Name:</strong>
                                                                {{ $member->applicant->first_name }}</p>
                                                            <p><strong>Last Name:</strong>
                                                                {{ $member->applicant->last_name }}</p>
                                                            <p><strong>Phone Number:</strong>
                                                                {{ $member->applicant->phone_number }}</p>
                                                            <p><strong>Email:</strong> {{ $member->applicant->email }}</p>
                                                            <p><strong>Profession:</strong>
                                                                {{ $member->applicant->profession }}</p>
                                                            <p><strong>Date of Birth:</strong>
                                                                {{ $member->applicant->date_of_birth }}</p>
                                                            <p><strong>Curriculum Vitae:</strong>
                                                                @if (!is_null($member->applicant->curriculumVitae))
                                                                    <a href="{{ asset($member->applicant->curriculumVitae->cv) }}"
                                                                        target="_blank"
                                                                        class="btn btn-outline-primary btn-sm">View CV</a>
                                                                @else
                                                                    <p>No CV uploaded</p>
                                                                @endif
                                                            </p>
                                                            <div class="mb-3">
                                                                <label><strong>Passport Photo:</strong></label>
                                                                @if (filled($member->applicant->passportPhoto))
                                                                    <div>
                                                                        <img src="{{ asset($member->applicant->passportPhoto->passport_photo) }}"
                                                                            alt="Passport Photo" class="img-fluid"
                                                                            style="width: 250px; height: 250px;">
                                                                    </div>
                                                                @else
                                                                    <p>No passport photo uploaded</p>
                                                                @endif
                                                            </div>
                                                            <div class="mb-3">
                                                                <label><strong>Payment Proof:</strong></label>
                                                                @if (filled($member->applicant->paymentProof))
                                                                    <div>
                                                                        <img src="{{ asset($member->applicant->paymentProof->payment_proof) }}"
                                                                            alt="Payment Proof" class="img-fluid"
                                                                            style="width: 250px; height: 250px;">
                                                                    </div>
                                                                @else
                                                                    <p>No payment proof uploaded</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
