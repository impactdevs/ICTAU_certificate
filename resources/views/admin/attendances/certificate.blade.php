<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICTAU Certificate</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
        }
        .certificate-container {
            height: 100vh;
            width: 100%;
            display: flex;
            /* justify-content: center; */
            /* align-items: center; */
        }
        .certificate-img {
            max-width: 100%;
            max-height: 100%;
            /* object-fit: contain; */
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        @if(file_exists(public_path('images/certificates/certificate_' . $id . '.png')))
            <img src="{{ public_path('images/certificates/certificate_' . $id . '.png') }}" alt="Certificate" height="100%" width="100%">

        @else
            <div style="color: red; text-align: center;">
                Certificate image not found. Please try regenerating.
            </div>
        @endif
    </div>
</body>
</html>