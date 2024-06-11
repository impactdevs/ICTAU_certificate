@extends('layouts.user_type.auth')

@section('content')
    @if ($applicant->application_type == 'company')
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h4 class="text-white">Application Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5 class="text-secondary">Company Details</h5>
                                    <p><strong>Company Name:</strong> {{ $applicant->company_name }}</p>
                                    <p><strong>Company Website:</strong> {{ $applicant->company_website }}</p>
                                    <p><strong>Niche:</strong> {{ $applicant->niche }}</p>
                                    <p><strong>Phone Number:</strong> {{ $applicant->phone_number }}</p>
                                    <p><strong>Email:</strong> {{ $applicant->email }}</p>
                                    <div class="mb-3">
                                        <label><strong>Company Logo:</strong></label>
                                        <div>
                                            <img src="{{ asset($applicant->companyLogo->logo) }}" alt="Company Logo"
                                                class="img-fluid" style="width: 250px; height: 250px;">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label><strong>Payment Proof:</strong></label>
                                        <div>
                                            <img src="{{ asset($applicant->paymentProof->payment_proof) }}"
                                                alt="Payment Proof" class="img-fluid" style="width: 250px; height: 250px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-secondary">Contact People</h5>
                                    @foreach ($applicant->contactPersons as $contactPerson)
                                        <p><strong>First Name:</strong> {{ $contactPerson->first_name }}</p>
                                        <p><strong>Last Name:</strong> {{ $contactPerson->last_name }}</p>
                                        <p><strong>Phone Number:</strong> {{ $contactPerson->phone_number }}</p>
                                        <p><strong>Email:</strong> {{ $contactPerson->email }}</p>
                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                            @if ($applicant->application_status == 'pending')
                                <a href="{{ '/approve?status=approve&application_id=' . $applicant->application_id }}"
                                    class="btn btn-success">Approve</a>
                                <a href="{{ '/approve?status=reject&application_id=' . $applicant->application_id }}"
                                    class="btn btn-danger">Reject</a>
                            @endif

                            @if ($applicant->application_status == 'reject')
                                {{-- show a font awesome cancel --}}
                                <i class="fas fa-times-circle text-danger"></i>
                            @endif

                            @if ($applicant->application_status == 'approve')
                                {{-- show a font awesome check --}}
                                <i class="fas fa-check-circle text-success"></i>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif($applicant->application_type == 'student')
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h4 class="text-white">Application Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5 class="text-secondary">Student Details</h5>
                                    <p><strong>First Name:</strong> {{ $applicant->first_name }}</p>
                                    <p><strong>Last Name:</strong> {{ $applicant->last_name }}</p>
                                    <p><strong>Phone Number:</strong> {{ $applicant->phone_number }}</p>
                                    <p><strong>Email:</strong> {{ $applicant->email }}</p>
                                    <p><strong>Institution: </strong> {{ $applicant->institution }}</p>
                                    <p><strong>Course:</strong> {{ $applicant->course }}</p>
                                    <p><strong>Date of Birth:</strong> {{ $applicant->date_of_birth }}</p>
                                    <div class="mb-3">
                                        <label><strong>Student ID:</strong></label>
                                        <div>
                                            <img src="{{ asset($applicant->studentId->student_id) }}" alt="Student ID"
                                                class="img-fluid" style="width: 250px; height: 250px;">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label><strong>Passport Photo:</strong></label>
                                        <div>
                                            <img src="{{ asset($applicant->passportPhoto->passport_photo) }}"
                                                alt="Passport Photo" class="img-fluid" style="width: 250px; height: 250px;">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label><strong>Payment Proof:</strong></label>
                                        <div>
                                            <img src="{{ asset($applicant->paymentProof->payment_proof) }}"
                                                alt="Payment Proof" class="img-fluid" style="width: 250px; height: 250px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($applicant->application_status == 'pending')
                                <a href="{{ '/approve?status=approve&application_id=' . $applicant->application_id }}"
                                    class="btn btn-success">Approve</a>
                                <a href="{{ '/approve?status=reject&application_id=' . $applicant->application_id }}"
                                    class="btn btn-danger">Reject</a>
                            @endif

                            @if ($applicant->application_status == 'reject')
                                {{-- show a font awesome cancel --}}
                                <i class="fas fa-times-circle text-danger"></i>
                            @endif

                            @if ($applicant->application_status == 'approve')
                                {{-- show a font awesome check --}}
                                <i class="fas fa-check-circle text-success"></i>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif($applicant->application_type == 'professional')
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h4 class="text-white">Application Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5 class="text-secondary">Professional Details</h5>
                                    <p><strong>First Name:</strong> {{ $applicant->first_name }}</p>
                                    <p><strong>Last Name:</strong> {{ $applicant->last_name }}</p>
                                    <p><strong>Phone Number:</strong> {{ $applicant->phone_number }}</p>
                                    <p><strong>Email:</strong> {{ $applicant->email }}</p>
                                    <p><strong>Profession:</strong> {{ $applicant->profession }}</p>
                                    <p><strong>Date of Birth:</strong> {{ $applicant->date_of_birth }}</p>
                                    <p><strong>Curriculum Vitae:</strong>
                                        <a href="{{ asset($applicant->curriculumVitae->cv) }}" target="_blank"
                                            class="btn btn-outline-primary btn-sm">View CV</a>
                                    </p>
                                    <div class="mb-3">
                                        <label><strong>Passport Photo:</strong></label>
                                        <div>
                                            <img src="{{ asset($applicant->passportPhoto->passport_photo) }}"
                                                alt="Passport Photo" class="img-fluid" style="width: 250px; height: 250px;">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label><strong>Payment Proof:</strong></label>
                                        <div>
                                            <img src="{{ asset($applicant->paymentProof->payment_proof) }}"
                                                alt="Payment Proof" class="img-thumbnail"
                                                style="width: 250px; height: 250px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($applicant->application_status == 'pending')
                                <a href="{{ '/approve?status=approve&application_id=' . $applicant->application_id }}"
                                    class="btn btn-success">Approve</a>
                                <a href="{{ '/approve?status=reject&application_id=' . $applicant->application_id }}"
                                    class="btn btn-danger">Reject</a>
                            @endif

                            @if ($applicant->application_status == 'reject')
                                {{-- show a font awesome cancel --}}
                                <i class="fas fa-times-circle text-danger"></i>
                            @endif

                            @if ($applicant->application_status == 'approve')
                                {{-- show a font awesome check --}}
                                <i class="fas fa-check-circle text-success"></i>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
