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
    <!-- Add this to your head section to load Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />
    <link id="pagestylecss" href="{{ asset('assets/css/custom-css.css?v=1.0.3') }}" rel="stylesheet" />
    <style>
        .container {
            font-family: Arial, sans-serif;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .payment-info p,
        .payment-categories p {
            font-size: 1rem;
            margin: 0.25rem 0;
        }

        .payment-info p strong,
        .payment-categories p strong {
            color: #0056b3;
        }

        .text-primary {
            color: #007bff !important;
        }

        .shadow {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .text-center {
            text-align: center;
        }

        .mt-5 {
            margin-top: 3rem;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body class="bg-gray-100 m-3">
    <div class="text-center">
        <img src="{{ asset('assets/img/ictaulogo.jpg') }}" class="navbar-brand-img h-25 w-25" alt="...">
        <div class="card-header">Register With ICTAU</div>
    </div>

    <nav class="">
        <p class="text-center font-weight-bold h6">Please select the category that best
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

        <div class="tab-pane fade {{ $category == 'student' ? 'show active' : '' }}" id="#" role="tabpanel"
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
        <div class="tab-pane fade {{ $category == 'professional' ? 'show active' : '' }}" id="#"
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
        <div class="tab-pane fade {{ $category == 'company' ? 'show active' : '' }}" id="#" role="tabpanel"
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
                                <h5 class="card-title text-center">Benefits of being a member</h5>
                                <div class="row">
                                    <div class="col-md-4 mt-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title text-center">Student</h5>
                                                <p class="card-text">Benefits of being a student member: <a
                                                        href="https://ictau.ug/#:~:text=ITEM-,Students,-Ugx.%2050%2C000/year">Checkout
                                                        all the benefits</a></p>
                                                <ol>
                                                    <li>Subscription to ICTAU Newsletter.</li>
                                                    <li>Attendance at ICTAU Events.</li>
                                                    <li>Voting Rights & Decision-Making</li>
                                                    <li>Local & International ICT Opportunities</li>
                                                    <li>Social Gatherings for Networking</li>
                                                    <li>Discounted Entry to ICTAU Events & Workshops</li>
                                                    <li>Graduate Training Sessions & Workshops</li>
                                                </ol>
                                                <a href="{{ url('/apply-to-become-a-member/student') }}"
                                                    class="btn btn-primary mt-2">Register as
                                                    Student</a>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title text-center">Professional</h5>
                                                <p class="card-text">The following are required.<a
                                                        href="https://ictau.ug/#:~:text=Ugx.%2050%2C000/year-,Professionals,-Ugx.%20200%2C000/year">Checkout
                                                        all the benefits</a></p>
                                                <ol>
                                                    <li>Subscription to ICTAU Newsletter.</li>
                                                    <li>Attendance at ICTAU Events.</li>
                                                    <li>Voting Rights & Decision-Making</li>
                                                    <li>Local & International ICT Opportunities</li>
                                                    <li>Social Gatherings for Networking</li>
                                                </ol>
                                                <a href="{{ url('/apply-to-become-a-member/professional') }}"
                                                    class="btn btn-primary mt-2">Register as
                                                    Professional</a>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title text-center">Company</h5>
                                                <p class="card-text">The following are required.<a
                                                        href="https://ictau.ug/#:~:text=Ugx.%20200%2C000/year-,Companies,-Ugx.%202%2C000%2C000/year">Checkout
                                                        all the benefits</a></p>
                                                <ol>
                                                    <li>Enhanced Visibility (Logo Display)</li>
                                                    <li>Access to Exclusive Opportunities & Financial Support</li>
                                                    <li>Recognition through appearances on promotional materials</li>
                                                    <li>Access to ICTAU’s network of professionals</li>
                                                    <li>Recognition in Promotional Materials</li>
                                                </ol>
                                                <a href="{{ url('/apply-to-become-a-member/company') }}"
                                                    class="btn btn-primary mt-2">Register as
                                                    Company</a>
                                                <br>
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

        <div class="container mt-5">
            <h1 class="text-center mb-4">Payment Details</h1>

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-4">Payment Details</h5>

                            <div class="payment-info mb-4">
                                <p><strong>Bank:</strong> Housing Finance Bank</p>
                                <p><strong>Account Number:</strong> 1040006744842</p>
                                <p><strong>Account Name:</strong> ICT Association of Uganda</p>
                            </div>

                            <div class="payment-categories">
                                <p><strong>Students:</strong> UGX 20,000</p>
                                <p><strong>Professionals:</strong> UGX 200,000</p>
                                <p><strong>Companies & MDAs:</strong> UGX 2,000,000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Section -->
        <footer class="footer bg-dark text-white py-4">
            <div class="container text-center">
                <p class="mb-2">© 2025 ICT Association of Uganda. All rights reserved.</p>
                <p>Designed and Developed by <a href="https://www.impactoutsourcing.co.ug/" class="text-white">Impact
                        Outsourcing</a>
                </p>
                <div class="social-icons mt-3">
                    <a href="https://www.facebook.com/yourpage" class="text-white mx-2" target="_blank"><i
                            class="fab fa-facebook-f"></i></a>
                    <a href="https://www.twitter.com/yourprofile" class="text-white mx-2" target="_blank"><i
                            class="fab fa-twitter"></i></a>
                    <a href="https://www.linkedin.com/in/yourprofile" class="text-white mx-2" target="_blank"><i
                            class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </footer>




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
