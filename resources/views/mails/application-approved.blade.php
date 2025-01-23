<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Application Approved</title>
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
            background-color: #28a745;
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
            color: #28a745;
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
            <h1>Membership Application Approved</h1>
        </div>
        <div class="content">
            <p>Dear {{ $first_name }},</p>

            <p>We are pleased to inform you that your application to join the ICT Association of Uganda (ICTAU) as a <strong>{{ $application_type }}</strong> has been reviewed and approved.</p>

            <p>Our committee will hold an election meeting to determine the next steps. We will keep you updated on the progress.</p>

            <p>We shall respond as soon as possible and look forward to welcoming you to our esteemed association. Congratulations!</p>
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
