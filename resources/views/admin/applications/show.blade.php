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
                                        @if (filled($applicant->companyLogo))
                                            <div>
                                                <img src="{{ asset($applicant->companyLogo->logo) }}" alt="Company Logo"
                                                    class="img-fluid" style="width: 250px; height: 250px;">
                                            </div>
                                        @else
                                            <p>No company logo uploaded</p>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label><strong>Payment Proof:</strong></label>
                                        @if (filled($applicant->paymentProof))
                                            <div>
                                                <img src="{{ asset($applicant->paymentProof->payment_proof) }}"
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
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Reject
                                </button>
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
                                        @if (filled($applicant->studentId))
                                            <div>
                                                <img src="{{ asset($applicant->studentId->student_id) }}" alt="Student ID"
                                                    class="img-fluid" style="width: 250px; height: 250px;">
                                            </div>
                                        @else
                                            <p>No student ID uploaded</p>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label><strong>Passport Photo:</strong></label>
                                        @if (filled($applicant->passportPhoto))
                                            <div>
                                                <img src="{{ asset($applicant->passportPhoto->passport_photo) }}"
                                                    alt="Passport Photo" class="img-fluid"
                                                    style="width: 250px; height: 250px;">
                                            </div>
                                        @else
                                            <p>No passport photo uploaded</p>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label><strong>Payment Proof:</strong></label>
                                        @if (filled($applicant->paymentProof))
                                            <div>
                                                <img src="{{ asset($applicant->paymentProof->payment_proof) }}"
                                                    alt="Payment Proof" class="img-fluid"
                                                    style="width: 250px; height: 250px;">
                                            </div>
                                        @else
                                            <p>No payment proof uploaded</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if ($applicant->application_status == 'pending')
                                <a href="{{ '/approve?status=approve&application_id=' . $applicant->application_id }}"
                                    class="btn btn-success">Approve</a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Reject
                                </button>
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
                                        @if (filled($applicant->curriculumVitae))
                                        <a href="{{ asset($applicant->curriculumVitae->cv) }}" target="_blank"
                                            class="btn btn-outline-primary btn-sm">View CV</a>
                                        @else
                                            <p>No CV uploaded</p>
                                    </p>
                                    <div class="mb-3">
                                        <label><strong>Passport Photo:</strong></label>
                                        @if (filled($applicant->passportPhoto))
                                            <div>
                                                <img src="{{ asset($applicant->passportPhoto->passport_photo) }}"
                                                    alt="Passport Photo" class="img-fluid"
                                                    style="width: 250px; height: 250px;">
                                            </div>
                                        @else
                                            <p>No passport photo uploaded</p>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label><strong>Payment Proof:</strong></label>
                                        @if (filled($applicant->paymentProof))
                                            <div>
                                                <img src="{{ asset($applicant->paymentProof->payment_proof) }}"
                                                    alt="Payment Proof" class="img-fluid"
                                                    style="width: 250px; height: 250px;">
                                            </div>
                                        @else
                                            <p>No payment proof uploaded</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if ($applicant->application_status == 'pending')
                                <a href="{{ '/approve?status=approve&application_id=' . $applicant->application_id }}"
                                    class="btn btn-success">Approve</a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Reject
                                </button>
                            @endif

                            @if ($applicant->application_status == 'reject')
                                {{-- show a font awesome cancel --}}
                                <i class="fas fa-times-circle text-danger"></i>Rejected. Awaiting update from the applicant
                            @endif

                            @if ($applicant->application_status == 'approve')
                                {{-- show a font awesome check --}}
                                <i class="fas fa-check-circle text-success"></i>Approved, everything is okay
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ '/approve?status=reject&application_id=' . $applicant->application_id }}">
                        {{-- hiddedn application_id field --}}
                        <input type="hidden" name="application_id" value="{{ $applicant->application_id }}">

                        {{-- status hidden field --}}
                        <input type="hidden" name="status" value="reject">
                        @csrf
                        <div class="modal-body">
                            <div class="container">
                                <label for="rejectionComments">Reasons:</label>
                                <textarea id="rejectionComments" name="rejection_comments" rows="20"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Reject Application</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- CKEditor CDN --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>

    {{-- load rejectcomments with ckeditor --}}
    <script>
        ClassicEditor
            .create(
                document.querySelector('#rejectionComments')

            )
            .catch(error => {
                console.error(error);
            });
        console.log('loaded');
    </script>
@endpush
