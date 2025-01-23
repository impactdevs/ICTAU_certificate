<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICTAU Membership Certificate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px;
            border: 1px solid #dddddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #dddddd;
        }

        .header img {
            width: 120px;
            height: auto;
        }

        .content {
            padding: 20px;
            text-align: center;
        }

        .content h1 {
            color: #333333;
            font-size: 24px;
            margin: 20px 0;
        }

        .content p {
            color: #666666;
            font-size: 16px;
            margin: 15px 0;
        }

        .content strong {
            color: #28a745;
        }

        .certificate {
            margin: 20px 0;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: #333333;
        }

        .footer {
            text-align: center;
            padding: 20px 0;
            background-color: #f1f1f1;
            color: #999999;
            font-size: 14px;
            border-top: 1px solid #dddddd;
            margin-top: 30px;
        }

        .footer pre {
            margin: 0;
            font-size: 14px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .footer .signature {
            font-weight: bold;
            color: #333333;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .payment-details {
            margin-top: 15px;
            color: #333333;
            font-size: 16px;
        }

        .payment-details p {
            margin: 5px 0;
        }

        .payment-details span {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{asset('assets/img/ictau-logo.jpg')}}" alt="ICTAU Logo">
        </div>
        <div class="content">
            <h1>Congratulations, {{ $applicant->first_name }}!</h1>
            <p>We are thrilled to present you with this <strong>Certificate of ICTAU Membership</strong>.</p>
            <p>We look forward to walking with you on this amazing journey as we work to enhance the ICT sector in Uganda. Once again, welcome to the ICTAU family!</p>
        </div>
        <div class="footer">
            <pre class="signature">
                Nkurunungi Gideon
                Chief Executive Officer
                ICT Association of Uganda
            </pre>
            <p>For more information, visit <a href="http://ictau.org" target="_blank">www.ictau.org</a></p>

            <!-- Payment Details Section -->
            <div class="payment-details">
                <p><span>Payment Details:</span></p>
                <p><span>Bank Name:</span> Example Bank</p>
                <p><span>Account Name:</span> ICT Association of Uganda</p>
                <p><span>Account Number:</span> 1234567890</p>
                <p><span>Branch:</span> Kampala Main Branch</p>
                <p><span>Swift Code:</span> EXBKEG22</p>
            </div>
        </div>
    </div>
</body>

</html>
