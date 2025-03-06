@if ($member->applicant->application_type == 'company')
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
                            <p><strong>Company Name:</strong> {{ $member->applicant->company_name }}</p>
                            <p><strong>Company Website:</strong> {{ $member->applicant->company_website }}</p>
                            <p><strong>Niche:</strong> {{ $member->applicant->niche }}</p>
                            <p><strong>Phone Number:</strong> {{ $member->applicant->phone_number }}</p>
                            <p><strong>Email:</strong> {{ $member->applicant->email }}</p>
                            <div class="mb-3">
                                <label><strong>Company Logo:</strong></label>
                                @if (filled($member->applicant->companyLogo))
                                    <div>
                                        <img src="{{ asset($member->applicant->companyLogo->logo) }}" alt="Company Logo"
                                            class="img-fluid" style="width: 250px; height: 250px;">
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
                                <p><strong>First Name:</strong> {{ $contactPerson->first_name }}</p>
                                <p><strong>Last Name:</strong> {{ $contactPerson->last_name }}</p>
                                <p><strong>Phone Number:</strong> {{ $contactPerson->phone_number }}</p>
                                <p><strong>Email:</strong> {{ $contactPerson->email }}</p>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                    @if ($member->applicant->application_status == 'pending')
                        <a href="{{ '/approve?status=approve&application_id=' . $member->applicant->application_id }}"
                            class="btn btn-success">Approve</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Reject
                        </button>
                    @endif

                    @if ($member->applicant->application_status == 'reject')
                        {{-- show a font awesome cancel --}}
                        <i class="fas fa-times-circle text-danger"></i>
                    @endif

                    @if ($member->applicant->application_status == 'approve')
                        {{-- show a font awesome check --}}
                        <i class="fas fa-check-circle text-success"></i>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@elseif($member->applicant->application_type == 'student')
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
                            <p><strong>First Name:</strong> {{ $member->applicant->first_name }}</p>
                            <p><strong>Last Name:</strong> {{ $member->applicant->last_name }}</p>
                            <p><strong>Phone Number:</strong> {{ $member->applicant->phone_number }}</p>
                            <p><strong>Email:</strong> {{ $member->applicant->email }}</p>
                            <p><strong>Institution: </strong> {{ $member->applicant->institution }}</p>
                            <p><strong>Course:</strong> {{ $member->applicant->course }}</p>
                            <p><strong>Date of Birth:</strong> {{ $member->applicant->date_of_birth }}</p>
                            <div class="mb-3">
                                <label><strong>Student ID:</strong></label>
                                @if (filled($member->applicant->studentId))
                                    <div>
                                        <img src="{{ asset($member->applicant->studentId->student_id) }}" alt="Student ID"
                                            class="img-fluid" style="width: 250px; height: 250px;">
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
                    @if ($member->applicant->application_status == 'pending')
                        <a href="{{ '/approve?status=approve&application_id=' . $member->applicant->application_id }}"
                            class="btn btn-success">Approve</a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Reject
                        </button>
                    @endif

                    @if ($member->applicant->application_status == 'reject')
                        {{-- show a font awesome cancel --}}
                        <i class="fas fa-times-circle text-danger"></i>
                    @endif

                    @if ($member->applicant->application_status == 'approve')
                        {{-- show a font awesome check --}}
                        <i class="fas fa-check-circle text-success"></i>
                    @endif
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
                    <h4 class="text-white">Application Details</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="text-secondary">Professional Details</h5>
                            <p><strong>First Name:</strong> {{ $member->applicant->first_name }}</p>
                            <p><strong>Last Name:</strong> {{ $member->applicant->last_name }}</p>
                            <p><strong>Phone Number:</strong> {{ $member->applicant->phone_number }}</p>
                            <p><strong>Email:</strong> {{ $member->applicant->email }}</p>
                            <p><strong>Profession:</strong> {{ $member->applicant->profession }}</p>
                            <p><strong>Date of Birth:</strong> {{ $member->applicant->date_of_birth }}</p>
                            <p><strong>Curriculum Vitae:</strong>
                                @if (!is_null($member->applicant->curriculumVitae))
                                    <a href="{{ asset($member->applicant->curriculumVitae->cv) }}" target="_blank"
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
                    @if ($member->applicant->application_status == 'pending')
                        <a href="{{ '/approve?status=approve&application_id=' . $member->applicant->application_id }}"
                            class="btn btn-success">Approve</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Reject
                        </button>
                    @endif

                    @if ($member->applicant->application_status == 'reject')
                        {{-- show a font awesome cancel --}}
                        <i class="fas fa-times-circle text-danger"></i>Rejected. Awaiting update from the applicant
                    @endif

                    @if ($member->applicant->application_status == 'approve')
                        {{-- show a font awesome check --}}
                        <i class="fas fa-check-circle text-success"></i>Approved, everything is okay
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endif