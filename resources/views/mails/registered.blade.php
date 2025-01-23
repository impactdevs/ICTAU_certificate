<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Application Update</title>
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
            background-color: #4CAF50;
            color: #fff;
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
            background-color: #f9f9f9;
        }

        .content p {
            margin: 10px 0;
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
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h1>ICTAU Membership Application Update</h1>
        </div>
        <div class="content">
            @if ($application_type == 'student' || $application_type == 'professional')
                <p>Dear {{ $first_name }},</p>

                <p>Thank you for expressing interest as a <strong>{{ $application_type }}</strong> to join ICTAU.</p>

                <p>Kindly update your bio-data information from the link below and submit your application:</p>
                <a href="{{ $update_link }}" style="background-color: #4CAF50; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none;">Update Bio-data</a>

            @elseif ($application_type == 'company')
                <p>Dear {{ $first_name }},</p>

                <p>Thank you for expressing interest as a <strong>{{ $application_type }}</strong> to join ICTAU.</p>

                <p>Kindly update your bio-data information from the link below and submit your application:</p>
                <a href="{{ $update_link }}" style="background-color: #4CAF50; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none;">Update Bio-data</a>
            @endif
        </div>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <div class="footer-info">
            <p><strong>Payment Details:</strong></p>
            <p><strong>Bank:</strong> Housing Finance Bank</p>
            <p><strong>Account Number:</strong> 1040006744842</p>
            <p><strong>Account Name:</strong> ICT Association of Uganda</p>
            <p><strong>Students:</strong> UGX 5,000</p>
            <p><strong>Professionals:</strong> UGX 200,000</p>
            <p><strong>Companies & MDAs:</strong> UGX 2,000,000</p>
            <p>For payment, please use the details above or <a href="mailto:info@ictau.org">contact us</a> for assistance.</p>
        </div>
        <div class="signature">
            <strong>Nkurunungi Gideon</strong><br>
            Chief Executive Officer<br>
            ICT Association of Uganda
        </div>
    </div>

</body>

</html>
