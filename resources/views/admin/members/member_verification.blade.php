<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ICTA UGANDA CERTIFICATION VERIFICATION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #ff8c00;
            /* Orange */
            color: #fff;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .card-body {
            padding: 20px;
        }

        h2 {
            margin-top: 0;
            margin-bottom: 20px;
            font-weight: bold;
            color: #ff8c00;
            /* Orange */
        }

        h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }

        .btn {
            background-color: #ff8c00;
            /* Orange */
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #cc7000;
            /* Darker shade of orange */
        }
    </style>
</head>

<body>
    @if ($member)
        {{-- verification success --}}
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h2>THE CERTIFICATE IS VALID</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Full Name: {{ $member->first_name }} {{ $member->last_name }}</h3>
                            <h3>Membership ID: {{ $member->membership_id }}</h3>
                            <h3>Membership Type: {{ $member->membershipType->membership_type_name }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h2>CERTIFICATE VERIFICATION FAILED</h2>
                </div>
                <div class="card-body">
                    <h3>The certificate is not valid. Please contact the ICTA Uganda for further assistance.</h3>
                </div>
            </div>
        </div>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
