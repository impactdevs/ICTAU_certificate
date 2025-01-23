<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Application Rejection</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .header {
            background-color: #ff4d4d;
            color: white;
            padding: 20px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .header h1 {
            margin: 0;
        }

        .content {
            padding: 30px;
            line-height: 1.6;
            background-color: #fff;
        }

        .content p {
            margin: 15px 0;
        }

        .content strong {
            color: #e74c3c;
        }

        .footer {
            background-color: #f1f1f1;
            padding: 20px;
            text-align: center;
            font-size: 0.9rem;
            color: #333;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .footer .signature {
            margin-top: 30px;
        }

        .footer .signature strong {
            display: block;
            margin-bottom: 5px;
        }

        .footer .footer-info p {
            margin: 5px 0;
        }

        .footer .footer-info a {
            color: #007bff;
            text-decoration: none;
        }

        .footer .footer-info a:hover {
            text-decoration: underline;
        }

        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h1>Membership Application Rejected</h1>
        </div>
        <div class="content">
            @if ($application_type == 'student' || $application_type == 'professional')
                <p>Dear {{ $first_name }},</p>

                <p>Your application to join the ICT Association of Uganda (ICTAU) as a <strong>{{ $application_type }}</strong> member has been reviewed. Unfortunately, the submitted bio-data information does not meet the required standards for membership.</p>

                <p><strong>Reason for rejection:</strong></p>
                <p>{!! $reason !!}</p>

                <p>To proceed with your application, kindly update your bio-data information from the link below and resubmit your application:</p>
                <a href="{{ $update_link }}" class="button">Update Bio-data</a>

            @elseif ($application_type == 'company')
                <p>Dear {{ $company_name }},</p>

                <p>Your application to join the ICT Association of Uganda (ICTAU) as a <strong>{{ $application_type }}</strong> member has been reviewed. Unfortunately, the submitted bio-data information does not meet the required standards for membership.</p>

                <p><strong>Reason for rejection:</strong></p>
                <p>{!! $reason !!}</p>

                <p>To proceed with your application, kindly update your bio-data information from the link below and resubmit your application:</p>
                <a href="{{ $update_link }}" class="button">Update Bio-data</a>
            @endif
        </div>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <div class="footer-info">
            <p>If you need further assistance, please don't hesitate to reach out to us.</p>
            <p>Best regards,</p>
        </div>
        <div class="signature">
            <strong>Nkurunungi Gideon</strong><br>
            Chief Executive Officer<br>
            ICT Association of Uganda
        </div>

        <div class="footer-info">
            <p>For more information, visit our <a href="https://www.ictau.org">website</a>.</p>
            <p>Follow us on <a href="https://www.facebook.com/ictauuganda">Facebook</a> | <a href="https://twitter.com/ictauuganda">Twitter</a></p>
        </div>
    </div>

</body>

</html>
