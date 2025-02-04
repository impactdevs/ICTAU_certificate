<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <title>
        ICTA UGANDA-SUMMIT REGISTRATION
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
        <img src="{{ asset('assets/img/ictaulogo.jpg') }}" class="navbar-brand-img h-25 w-25" alt="...">
        <div class="card-header">Register Your Attendance, you will receive a certificate on the email you will provide.
        </div>
    </div>

    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('attendance.store') }}" accept-charset="UTF-8"
                            class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            @include ('admin.applications.attend')
                        </form>
                    </div>
                </div>
            </div>
        </div>
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


        // In your Attendance model (attendance.php)

class Attendance extends Model
{
    protected $fillable = [
        'attendee_name', // assuming this is the field you already have
        'event_id',      // Add the event_id field
        // Add any other necessary fields here
    ];

    // If you have an Event model, define the relationship
    public function event()
    {
        return $this->belongsTo(Event::class);  // Assuming you have an Event model
    }
}


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
