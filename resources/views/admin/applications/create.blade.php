<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <title>
        ICTA UGANDA
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />
    <link id="pagestylecss" href="{{ asset('assets/css/custom-css.css?v=1.0.3') }}" rel="stylesheet" />
</head>

<body class="bg-gray-100 m-3">
    <div class="text-center">
        <img src="{{ asset('assets/img/ictau-logo.jpg') }}" class="navbar-brand-img h-100" alt="...">
        <div class="card-header">Register With ICTAU</div>
    </div>

    <nav class="">
        <p class="text-center font-weight-bold h6">Select the category that best
            describes you from the tabs below.</p>
        <div class="nav nav-tabs nav-fill nav-underline" id="nav-tab" role="tablist">
            <button class="nav-link tab-color {{ $category == 'student' ? 'active' : '' }}" id="student-tab"
                data-bs-toggle="pill" data-bs-target="#student" type="button" role="tab" aria-controls="student"
                aria-selected="{{ $category == 'student' ? 'true' : 'false' }}">
                <i class="fa fa-address-card-o" aria-hidden="true"></i>
                Student
            </button>
            <button class="nav-link tab-color {{ $category == 'professional' ? 'active' : '' }}" id="professional-tab"
                data-bs-toggle="pill" data-bs-target="#professional" type="button" role="tab"
                aria-controls="professional" aria-selected="{{ $category == 'professional' ? 'true' : 'false' }}"><i
                    class="fa fa-user-circle-o" aria-hidden="true"></i>
                Professional</button>
            <button class="nav-link tab-color {{ $category == 'company' ? 'active' : '' }}" id="company-tab"
                data-bs-toggle="pill" data-bs-target="#company" type="button" role="tab" aria-controls="company"
                aria-selected="{{ $category == 'company' ? 'true' : 'false' }}"><i class="fa fa-university"
                    aria-hidden="true"></i>Company</button>
        </div>
    </nav>

    <div class="tab-content" id="pills-tabContent">

        <div class="tab-pane fade {{ $category == 'student' ? 'show active' : '' }}" id="student" role="tabpanel"
            aria-labelledby="student-tab">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ url('/application-store') }}" accept-charset="UTF-8"
                                    class="form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="activeTab" value="student">
                                    @include ('admin.applications.form-student', ['formMode' => 'create'])
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade {{ $category == 'professional' ? 'show active' : '' }}" id="professional"
            role="tabpanel" aria-labelledby="professional-tab">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ url('/application-store') }}" accept-charset="UTF-8"
                                    class="form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="activeTab" value="professional">
                                    @include ('admin.applications.form-professional', [
                                        'formMode' => 'create',
                                    ])
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade {{ $category == 'company' ? 'show active' : '' }}" id="company" role="tabpanel"
            aria-labelledby="company-tab">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ url('/application-store') }}" accept-charset="UTF-8"
                                    class="form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="activeTab" value="company">
                                    @include ('admin.applications.form-company', ['formMode' => 'create'])
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- if there is no session --}}
        @if (!$category)
            {{-- form requirements like a photo of student id for students etc. put them into sections[student, professional, and company] --}}
            <div class="content-wrapper requirements">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">Pre-Requirements</h5>
                                <div class="row">
                                    <div class="col-md-4 mt-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title text-center">Student</h5>
                                                <p class="card-text">The following are a must requirements you must
                                                    have to fill in your bio-data form.</p>
                                                <ol>
                                                    <li>Student ID screenshot in .png or .jpg format</li>
                                                    <li>A passport size photograph in .png or .jpg format</li>
                                                    <li>Membership payment prooof in .png or .jpg format</li>
                                                </ol>
                                                <a href="{{ url('/apply?category=student') }}" class="btn btn-primary mt-2">Register as
                                                    Student</a>
                                                <br>
                                                NB: All fields marked with <strong>*</strong> mandatory
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title text-center">Professional</h5>
                                                <p class="card-text">The following are a must requirements you must
                                                    have to fill in your bio-data form.</p>
                                                <ol>
                                                    <li>A curriculum vitae in .pdf format</li>
                                                    <li>A passport size photograph .png or .jpg format</li>
                                                    <li>Membership payment prooof .png or .jpg format</li>
                                                </ol>
                                                <a href="{{ url('/apply?category=professional') }}" class="btn btn-primary mt-2">Register as
                                                    Professional</a>
                                                <br>
                                                NB: All fields marked with <strong>*</strong> mandatory
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title text-center">Company</h5>
                                                <p class="card-text">The following are a must requirements you must
                                                    have to fill in your bio-data form.</p>
                                                <ol>
                                                    <li>Company logo .png or .jpg format</li>
                                                    <li>Membership payment prooof</li>
                                                    <li>Atleast one contact person details[first name, last name, email
                                                        and phone number]. Maximum is three people</li>
                                                </ol>
                                                <a href="{{ url('/apply?category=company') }}" class="btn btn-primary mt-2">Register as
                                                    Company</a>
                                                <br>
                                                NB: All fields marked with <strong>*</strong> mandatory
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>


    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @stack('rtl')
    @stack('dashboard')
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>

    <script>
        $(document).ready(function() {
            var tabEl = document.querySelectorAll('button[data-bs-toggle="pill"]');
            var activated_pane = "{{ $category ?? 'student' }}";
            for (i = 0; i < tabEl.length; i++) {
                tabEl[i].addEventListener("shown.bs.tab", function(event) {
                    activated_pane = document.querySelector(
                        event.target.getAttribute("data-bs-target")
                    ).id;
                    $('input[name="activeTab"]').val(activated_pane);
                    //hide the pre-requirements section when a tab is clicked

                    $('.requirements').hide();

                });
            }
            $('.form-control-file').on('change', function(event) {
                const fileInput = $(this);
                const previewContainer = $('#preview-' + fileInput.attr('id'));

                previewContainer.empty(); // Clear previous preview

                if (fileInput[0].files && fileInput[0].files[0]) {
                    const file = fileInput[0].files[0];

                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const imgElement = $('<img>').attr('src', e.target.result).addClass(
                                'img-fluid mt-2');
                            previewContainer.append(imgElement);
                        };
                        reader.readAsDataURL(file);
                    } else {
                        const fileInfo = $('<div>').text('Selected file: ' + file.name);
                        previewContainer.append(fileInfo);
                    }
                }
            });
        });

        //show swal alert
        @if (session('success'))
            swal({
                title: "Success!",
                text: "{{ session('success') }}",
                icon: "success",
                button: "OK",
            });
        @elseif (session('error'))
            swal({
                title: "Error!",
                text: "{{ session('error') }}",
                icon: "error",
                button: "OK",
            });
        @endif
    </script>
</body>

</html>
