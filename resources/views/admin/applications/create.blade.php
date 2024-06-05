<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href={{ asset('assets/img/apple-icon.png') }}>
    <link rel="icon" type="image/png" href={{ asset('assets/img/favicon.png') }}>
    <title>
        ICTA UGANDA
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css" rel="stylesheet') }}" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href={{ asset('assets/css/nucleo-svg.css" rel="stylesheet') }} />
    <!-- CSS Files -->
    <link id="pagestyle" href={{ asset('assets/css/soft-ui-dashboard.css?v=1.0.3') }} rel="stylesheet" />
    <link id="pagestylecss" href={{ asset('assets/css/custom-css.css?v=1.0.3') }} rel="stylesheet" />

</head>

<body class="bg-gray-100 m-3">
    <div class="text-center">
        <img src="{{ asset('assets/img/ictau-logo.jpg') }}" class="navbar-brand-img h-100" alt="...">
        <div class="card-header">Register With ICTAU</div>
        <p class="text-center">Please fill in the form below to register with ICTAU. Select the category that best
            describes you from the tabs below.</p>
            <p class="text-center">All fields marked with <stron>*</strong> mandatory</p>

    </div>

    <nav class="">
        <div class="nav nav-tabs nav-fill nav-underline" id="nav-tab" role="tablist">
            <button class="nav-link active tab-color" id="student-tab" data-bs-toggle="pill" data-bs-target="#student"
                type="button" role="tab" aria-controls="student" aria-selected="true">Student</button>
            <button class="nav-link tab-color" id="professional-tab" data-bs-toggle="pill"
                data-bs-target="#professional" type="button" role="tab" aria-controls="professional"
                aria-selected="false">Professional</button>

            <button class="nav-link tab-color" id="company-tab" data-bs-toggle="pill" data-bs-target="#company"
                type="button" role="tab" aria-controls="company" aria-selected="false">Company</button>

        </div>
    </nav>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="student" role="tabpanel" aria-labelledby="student-tab">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ url('/application-store') }}" accept-charset="UTF-8"
                                    class="form-horizontal" enctype="multipart/form-data">
                                    @csrf

                                    @include ('admin.applications.form-student', ['formMode' => 'create'])

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="professional" role="tabpanel" aria-labelledby="professional-tab">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ url('/application-store') }}" accept-charset="UTF-8"
                                    class="form-horizontal" enctype="multipart/form-data">
                                    @csrf

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
        <div class="tab-pane fade" id="company" role="tabpanel" aria-labelledby="company-tab">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ url('/application-store') }}" accept-charset="UTF-8"
                                    class="form-horizontal" enctype="multipart/form-data">
                                    @csrf

                                    @include ('admin.applications.form-company', ['formMode' => 'create'])

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src={{ asset('assets/js/core/popper.min.js') }}></script>
    <script src={{ asset('assets/js/core/bootstrap.min.js') }}></script>
    <script src={{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}></script>
    <script src={{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}></script>
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
    <script src={{ asset('assets/js/soft-ui-dashboard.min.js?v=1.0.3') }}></script>

    <script>
        $(document).ready(function() {
            var tabEl = document.querySelectorAll('button[data-bs-toggle="pill"]');
            var activated_pane = "student";
            for (i = 0; i < tabEl.length; i++) {
                tabEl[i].addEventListener("shown.bs.tab", function(event) {
                    activated_pane = document.querySelector(
                        event.target.getAttribute("data-bs-target")
                    );
                    const deactivated_pane = document.querySelector(
                        event.relatedTarget.getAttribute("data-bs-target")
                    );
                    console.log(activated_pane.id);
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
            //else if error
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
